<?php

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

  Route::post('/authenticate/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

  Route::group(['middleware' => ['auth']], function () {

  Route::post('/authenticate/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
  Route::get('/administration/user/getListUsers', [App\Http\Controllers\Administration\usersController::class, 'getListUsers']);
  Route::get('/administration/user/getUser/{id}', [App\Http\Controllers\Administration\usersController::class, 'getUser']);
  Route::post('/administration/user/setCreateUser', [App\Http\Controllers\Administration\usersController::class, 'setCreateUser']);
  Route::post('/administration/user/editUser/{id}', [App\Http\Controllers\Administration\usersController::class, 'editUser']);

});

Route::get('/{optional?}', function () {
    return view('app');
})->name('basePath')
  ->where('optional', '.*');