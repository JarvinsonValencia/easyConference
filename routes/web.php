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
Route::post('/administration/user/setCreateUser', [App\Http\Controllers\Administration\UsersController::class, 'setCreatePerson']);

  Route::group(['middleware' => ['auth']], function () {

 Route::post('/authenticate/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
  Route::get('/administration/person/getListPersons', [App\Http\Controllers\Administration\PersonsController::class, 'getListPersons']);
  Route::get('/administration/person/getPerson/{id}', [App\Http\Controllers\Administration\PersonsController::class, 'getPerson']);
  Route::post('/administration/person/setCreatePerson', [App\Http\Controllers\Administration\PersonsController::class, 'setCreatePerson']);
  Route::post('/administration/person/editPerson/{id}', [App\Http\Controllers\Administration\PersonsController::class, 'editPerson']);

});

Route::get('/{optional?}', function () {
    return view('app');
})->name('basePath')
  ->where('optional', '.*');