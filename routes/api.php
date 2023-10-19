<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherTypeController;
use App\Http\Controllers\UserController;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:sanctum')->group(function () {
    // Защищенные маршруты
    Route::get('/users', [UserController::class, 'index']);
    Route::put('/users/update-accesses', [UserController::class, 'updateAccesses']);
    Route::get('/teachers', [TeacherController::class, 'index']);
    Route::get('/teacher-types/titles',[TeacherTypeController::class, 'index']);
    Route::get('/teacher/loading_next',[TeacherController::class, 'getNextTeacher']);
    Route::get('/teacher/edit_teacher',[TeacherController::class, 'updateTeacherData']);
    Route::get('/teacher-specialization',[TeacherController::class, 'specializationData']);
    Route::delete('/teacher/delete/{id}', [TeacherController::class, 'delete_teacher']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::get('/country', [CountryController::class, 'index']);
Route::post('register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
