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


Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('checkemail',[UserController::class, 'checkEmail']);
Route::post('checkname',[UserController::class, 'checkName']);
Route::post('store_file',[UserController::class, 'fileStore']);
Route::group([ 'middleware' => 'auth:sanctum'], function () {
   Route::get('getservices', [MainController::class, 'getServices']);
   //Route::get('/', [BookController::class, 'index']);
    Route::post('addservice', [MainController::class, 'addService']);
    Route::put('editservice/{id}', [MainController::class, 'editService']);
    //Route::post('update/{id}', [MainController::class, 'update']);
    Route::delete('deleteservice/{id}', [MainController::class, 'delService']);
});
