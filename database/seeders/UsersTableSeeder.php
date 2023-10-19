<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Александр',
            'surname' => 'Бутко',
            'patronymic' => 'Олегович',
            'nickname' => 'sharpsss',
            'email' => 'sharp',
            'accesses' => '123456789',
            'password' => Hash::make('sharp'),
        ]);
    }
}
