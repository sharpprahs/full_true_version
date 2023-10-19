<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrammarpostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Удалите существующие данные из таблицы
        DB::table('grammarpost')->delete();

        // Путь к SQL-файлу с данными
        $sqlFilePath = database_path('migrations/grammarpost.sql');

        // Загрузите содержимое SQL-файла
        $sql = file_get_contents($sqlFilePath);

        // Выполните SQL-запрос для импорта данных
        DB::unprepared($sql);

        // Сбросьте идентификаторы (AUTO_INCREMENT)
        DB::statement('ALTER TABLE podcast AUTO_INCREMENT = 1');
    }
}
