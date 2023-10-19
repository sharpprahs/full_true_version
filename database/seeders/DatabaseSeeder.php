<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(TeacherTableSeeder::class);
        $this->call(VideoTableSeeder::class);
        $this->call(PodcastTableSeeder::class);
        $this->call(BlogpostTableSeeder::class);
        $this->call(BlogtagTableSeeder::class);
        $this->call(BlogpostaudioTableSeeder::class);
        $this->call(Blogpost2BlogtagTableSeeder::class);
        $this->call(Blogpost2ProgramTableSeeder::class);
        $this->call(Blogpost2ProgramtypeTableSeeder::class);
        $this->call(GrammarlevelTableSeeder::class);
        $this->call(GrammarpostTableSeeder::class);
        $this->call(GrammartestTableSeeder::class);
        $this->call(Podcast2TeacherTableSeeder::class);
        $this->call(PodcastGuestTableSeeder::class);
        $this->call(PodcastlanguageTableSeeder::class);
        $this->call(PodcastscriptTableSeeder::class);
        $this->call(TeacherCertificateTableSeeder::class);
        $this->call(TeacherCertificateTypeTableSeeder::class);
        $this->call(TeacherImageTableSeeder::class);
        $this->call(TeacherSpecTableSeeder::class);
        $this->call(TeachertypeTableSeeder::class);
        $this->call(Teacher2TeacherspecTableSeeder::class);
        $this->call(Video2TeacherTableSeeder::class);
        $this->call(VideocategoryTableSeeder::class);
        $this->call(VideoposTableSeeder::class);
    }
}
