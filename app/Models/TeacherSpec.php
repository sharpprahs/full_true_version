<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSpec extends Model
{
    use HasFactory;
    protected $table = 'teacherspec'; // Название таблицы в базе данных
    protected $fillable = ['id','image','pos','title','comment','page'];
}
