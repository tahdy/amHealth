<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::group([ 'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],'middleware'=>'language'],function () {
    Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('homepage');
}
);
Route::group(['prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],'middleware'=>['language']], function () {
    Route::get('{any}', [\App\Http\Controllers\MainController::class, 'index']);

});



