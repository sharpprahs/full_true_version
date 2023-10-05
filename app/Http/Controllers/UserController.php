<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('name', 'surname', 'patronymic', 'nickname', 'accesses')->get();
        return response()->json($users);
    }
    public function updateAccesses(Request $request)
    {
        // Добавьте этот код для отладки
//        \Log::debug('Received data:', $request->all());
        // Валидация входящих данных
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'required',
            'accesses' => 'required',
        ]);

        // Извлекаем данные из запроса
        $name = $request->input('name');
        $surname = $request->input('surname');
        $patronymic = $request->input('patronymic');
        $accesses = $request->input('accesses');

        // Находим пользователя по заданным критериям
        $user = User::where('name', $name)
            ->where('surname', $surname)
            ->where('patronymic', $patronymic)
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        // Обновляем поле accesses
        $user->accesses = $accesses;
        $user->save();

        return response()->json(['message' => 'Доступы пользователя обновлены', 'user' => $user]);
    }
}
