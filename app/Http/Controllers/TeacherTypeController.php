<?php

namespace App\Http\Controllers;

use App\Models\TeacherType;
use Illuminate\Http\Request;

class TeacherTypeController extends Controller
{
    public function index()
    {
        $titles = TeacherType::select('id','title')->get();
        return response()->json($titles);
    }
}
