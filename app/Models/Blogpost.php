<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogpost extends Model
{
    use HasFactory;
    protected $table = 'blogpost';
    protected $fillable = ['id','teacher_id','title','content','date','image','metaTitle','metaDescription','metaKeywords','ogTitle','ogDescription','ogSiteName','url','urlShort','footerNative','footerRussian'];
}
