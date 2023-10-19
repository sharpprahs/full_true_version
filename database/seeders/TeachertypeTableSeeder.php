<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeachertypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         // Удалите существующие данные из таблицы
        DB::table('teachertype')->delete();

        // Путь к SQL-файлу с данными
        $sqlFilePath = database_path('migrations/teachertype.sql');

        // Загрузите содержимое SQL-файла
        $sql = file_get_contents($sqlFilePath);

        // Выполните SQL-запрос для импорта данных
        DB::unprepared($sql);
    }
}
