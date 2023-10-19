<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function index()
    {
     $countries = Country::select('image', 'pos', 'title')->get();
        return response()->json($countries);
    }
}
