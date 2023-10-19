<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Blogpost2ProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Удалите существующие данные из таблицы
        DB::table('blogpost2program')->delete();

        // Вставьте данные из SQL-файла
        $sqlFilePath = database_path('migrations/blogpost2program.sql');
        $sql = file_get_contents($sqlFilePath);
        DB::unprepared($sql);
    }
}
