<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherCertificate extends Model
{
    use HasFactory;
    protected $table = 'teachercertificate';
    protected $fillable = ['id','teacher_id','image','main','pos','title','teacherCertificateType'];
}
