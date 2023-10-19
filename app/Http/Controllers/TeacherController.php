<?php

namespace App\Http\Controllers;

use App\Models\TeacherSpec;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        // Получите номер страницы из параметра запроса 'page' (по умолчанию 1)
        $page = $request->query('page', 1);

        // Получите значение title из параметра запроса
        $title = $request->input('title');

        // Количество записей на странице (11 записей на страницу)
        $perPage = 11;

        $query = Teacher::with('teacherType:id,title')
            ->select('id', 'posBlog', 'podcastPos', 'title', 'place', 'teacherType');

        // Фильтруем записи по title, если значение title передано в запросе
        if ($title && $title !== "Все") {
            $query->whereHas('teacherType', function ($subquery) use ($title) {
                $subquery->where('title', $title);
            });
        }

        $teachers = $query->paginate($perPage, ['*'], 'page', $page);

        $totalCount = $query->count(); // Получите общее количество записей

        return response()->json([
            'total' => $totalCount,
            'data' => $teachers,
        ]);
    }
    public function getNextTeacher(Request $request)
    {
        $id = $request->input('id');
        $title = $request->input('title');

        $query = Teacher::with('teacherType:id,title')
            ->select('id', 'posBlog', 'podcastPos', 'title', 'place', 'teacherType')
            ->where('id', '>', $id); // Найти записи с id больше указанного

        // Если title задан и не равен "Все", добавьте условие фильтрации по title
        if ($title && $title !== "Все") {
            $query->whereHas('teacherType', function ($subquery) use ($title) {
                $subquery->where('title', $title);
            });
        }

        $nextTeacher = $query->first();

        return response()->json(['data' => $nextTeacher]);
    }
    public function delete_teacher(Request $request, $id)
    {
        // Найдите учителя по переданному id
        $teacher = Teacher::find($id);

        if (!$teacher) {
            // Учитель с таким id не найден
            return response()->json(['message' => 'Учитель не найден'], 404);
        }

        // Удалите связанные записи из teachercertificate и teacher2teacherspec
        $teacher->teacherCertificates()->delete();
        $teacher->teacherSpecs()->delete();
        $teacher->blogposts()->delete();

        // Удалите записи из teacherimage, где teacher == $id
        DB::table('teacherimage')->where('teacher', $id)->delete();

        // Удалите учителя
        $teacher->delete();

        // Верните ответ, указывая, что учитель успешно удален
        return response()->json(['message' => 'Учитель успешно удален']);
    }
    public function updateTeacherData(Request $request)
    {
        // Получаем данные из запроса
        $id = $request->input('id');
        $place = $request->input('place');
        $podcastPos = $request->input('podcastPos');
        $posBlog = $request->input('posBlog');
        $teacherType = $request->input('teacherType');
        $title = $request->input('title');

        // Находим запись преподавателя
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json(['message' => 'Преподаватель не найден'], 404);
        }

        // Устанавливаем новые значения полей
        $teacher->place = $place;
        $teacher->podcastPos = $podcastPos;
        $teacher->posBlog = $posBlog;
        $teacher->teacherType = $teacherType;
        $teacher->title = $title;

        // Проверяем, были ли какие-либо изменения
        if ($teacher->isDirty()) {
            // Если есть изменения, сохраняем их и возвращаем успех
            $teacher->save();
            return response()->json(['message' => 'Данные успешно обновлены'], 200);
        } else {
            // Если изменений нет, возвращаем сообщение об отсутствии изменений
            return response()->json(['message' => 'Нет изменений в данных'], 200);
        }
    }
    public function specializationData()
    {
        // Получить только id и title из таблицы teacherspec
        $specializations = TeacherSpec::select('id', 'title')->get();

        // Вернуть данные в формате JSON
        return response()->json($specializations, 200);
    }
}
