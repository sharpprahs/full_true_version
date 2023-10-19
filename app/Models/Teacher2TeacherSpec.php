<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher2TeacherSpec extends Model
{
    use HasFactory;
    protected $table = 'teacher2teacherspec';
    protected $fillable = ['teacher_id','teacherSpec'];
}
