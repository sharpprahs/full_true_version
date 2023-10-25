<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function index()
    {
//     $countries = Country::select('id','image', 'pos', 'title')->get();
     $countries = Country::select('title')->get();
        return response()->json($countries);
    }
}
