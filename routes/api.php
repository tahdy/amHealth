<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Route::post('login', [UserController::class, 'login']);
Route::post('login', [\App\Http\Controllers\API\LoginController::class,'login']);

Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('checkemail',[UserController::class, 'checkEmail']);
Route::post('checkname',[UserController::class, 'checkName']);
Route::post('store_file',[UserController::class, 'fileStore']);
Route::group([ 'middleware' => 'auth:sanctum'], function () {
    Route::post('addservice', [MainController::class, 'addService']);
    Route::put('editservice/{id}', [MainController::class, 'editService']);
    Route::delete('deleteservice/{id}', [MainController::class, 'delService']);
    Route::post('adddepartment', [MainController::class, 'adddepartment']);
    Route::put('editdepartment/{id}', [MainController::class, 'editdepartment']);
    Route::delete('deletedepartment/{id}', [MainController::class, 'deldepartment']);
    Route::delete('delfile', [MainController::class, 'delFile']);
    Route::post('addabout_paragraph', [MainController::class, 'addAbout_paragraph']);
    Route::put('editabout_paragraph/{id}', [MainController::class, 'editAbout_paragraph']);
    Route::delete('deleteabout_paragraph/{id}', [MainController::class, 'delAbout_paragraph']);
    Route::post('addwhy_paragraph', [MainController::class, 'addwhy_paragraph']);
    Route::put('editwhy_paragraph/{id}', [MainController::class, 'editwhy_paragraph']);
    Route::delete('deletequestion/{id}', [MainController::class, 'delquestion']);
    Route::post('addquestion', [MainController::class, 'addquestion']);
    Route::put('editquestion/{id}', [MainController::class, 'editquestion']);
    Route::delete('deletequestion/{id}', [MainController::class, 'delquestion']);
    Route::get('getpage_datas', [MainController::class, 'getpage_datas']);
    Route::post('addpage_data', [MainController::class, 'addpage_data']);
    Route::put('editpage_data/{id}', [MainController::class, 'editpage_data']);
    Route::delete('deletepage_data/{id}', [MainController::class, 'delpage_data']);
    Route::get('getusers', [MainController::class, 'getUsers']);
    Route::get('getuser/{id}', [MainController::class, 'getUser']);
    Route::post('adduser', [UserController::class, 'addUser']);
    Route::put('edituser/{id}', [UserController::class, 'editUser']);
    Route::put('edituserpassword/{id}', [UserController::class, 'editUserPaaword']);
    Route::delete('deleteuser/{id}', [UserController::class, 'delUser']);
    Route::get('getuserscount', [MainController::class, 'getUsersCount']);
    Route::get('getdoctors', [MainController::class, 'getDoctors']);
    Route::get('getdoctorscount', [MainController::class, 'getDoctorsCount']);
    Route::put('editdoctor/{id}', [MainController::class, 'editDoctor']);
    Route::delete('deletedoctor/{id}', [MainController::class, 'delDoctor']);
    Route::get('getpatients', [MainController::class, 'getPatients']);
    Route::get('getpatientscount', [MainController::class, 'getPatientsCount']);
    Route::put('editpatient/{id}', [MainController::class, 'editPatient']);
    Route::delete('deletepatient/{id}', [MainController::class, 'delPatient']);
    Route::get('getpatient/{id}', [MainController::class, 'getPatient']);
    Route::post('addvisit', [MainController::class, 'addvisit']);
    Route::put('editvisit/{id}', [MainController::class, 'editvisit']);
    Route::delete('deletevisit/{id}', [MainController::class, 'delvisit']);
});
Route::get('getpage_data', [MainController::class, 'getpage_data']);
Route::get('getquestions', [MainController::class, 'getquestions']);
Route::get('getwhy_paragraphs', [MainController::class, 'getwhy_paragraphs']);
Route::get('getabout_paragraphs', [MainController::class, 'getAbout_paragraphs']);
Route::get('getdepartments', [MainController::class, 'getdepartments']);
Route::get('getservices', [MainController::class, 'getServices']);
