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
            'name' => 'Sas',
            'surname' => 'Saas',
            'patronymic' => 'zzZ',
            'nickname' => 'random',
            'email' => 'shards@example.com',
            'accesses' => '123',
            'password' => Hash::make('Shards'),
        ]);
    }
}
