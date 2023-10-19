<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Blogpost2BlogtagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Удалите существующие данные из таблицы
        DB::table('blogpost2blogtag')->delete();

        // Вставьте данные из SQL-файла
        $sqlFilePath = database_path('migrations/blogpost2blogtag.sql');
        $sql = file_get_contents($sqlFilePath);
        DB::unprepared($sql);
    }
}
