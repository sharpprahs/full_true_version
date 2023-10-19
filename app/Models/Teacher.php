<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teacher';
    protected $fillable = ['id','posBlog', 'podcastPos', 'title','place','teacherType'];
    public function teacherType()
    {
        return $this->belongsTo(TeacherType::class, 'teacherType', 'id');
    }
    public function teacherCertificates()
    {
        return $this->hasMany(TeacherCertificate::class);
    }

    public function teacherSpecs()
    {
        return $this->hasMany(Teacher2TeacherSpec::class);
    }
    public function blogposts()
    {
        return $this->hasMany(Blogpost::class);
    }
}
