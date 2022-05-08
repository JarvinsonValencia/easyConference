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

  //Route::group(['middleware' => ['auth']], function () {

  Route::post('/authenticate/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

  Route::get('/administration/user/getListUsers/{role_id}/{client_id}', [App\Http\Controllers\Administration\UsersController::class, 'getListUsers']);
  Route::get('/administration/user/getUser/{id}', [App\Http\Controllers\Administration\UsersController::class, 'getUser']);
  Route::post('/administration/user/setCreateUser', [App\Http\Controllers\Administration\UsersController::class, 'setCreateUser']);
  Route::post('/administration/user/editUser/{id}', [App\Http\Controllers\Administration\UsersController::class, 'editUser']);
  Route::delete('/administration/user/deleteUser/{id}', [App\Http\Controllers\Administration\UsersController::class, 'deleteUser']);

  Route::get('/administration/activity/getListActivities/{role_id}/{id}', [App\Http\Controllers\Administration\ActivitiesController::class, 'getListActivities']);
  Route::get('/administration/activity/getActivity/{id}', [App\Http\Controllers\Administration\ActivitiesController::class, 'getActivity']);
  Route::post('/administration/activity/setCreateActivity', [App\Http\Controllers\Administration\ActivitiesController::class, 'setCreateActivity']);
  Route::post('/administration/activity/editActivity/{id}', [App\Http\Controllers\Administration\ActivitiesController::class, 'editActivity']);
  Route::delete('/administration/activity/deleteActivity/{id}', [App\Http\Controllers\Administration\ActivitiesController::class, 'deleteActivity']);

  Route::get('/administration/client/getListClients', [App\Http\Controllers\Administration\ClientsController::class, 'getListClients']);
  Route::get('/administration/client/getClient/{id}', [App\Http\Controllers\Administration\ClientsController::class, 'getClient']);
  Route::post('/administration/client/setCreateClient', [App\Http\Controllers\Administration\ClientsController::class, 'setCreateClient']);
  Route::post('/administration/client/editClient/{id}', [App\Http\Controllers\Administration\ClientsController::class, 'editClient']);
  Route::delete('/administration/client/deleteClient/{id}', [App\Http\Controllers\Administration\ClientsController::class, 'deleteClient']);
   
  Route::get('/administration/meet/getListMeetings/{role_id}/{client_id}', [App\Http\Controllers\Administration\MeetingsController::class, 'getListMeetings']);
  Route::get('/administration/meet/getMeet/{id}', [App\Http\Controllers\Administration\MeetingsController::class, 'getMeet']);
  Route::post('/administration/meet/setCreateMeet', [App\Http\Controllers\Administration\MeetingsController::class, 'setCreateMeet']);
  Route::post('/administration/meet/editMeet/{id}', [App\Http\Controllers\Administration\MeetingsController::class, 'editMeet']);
  Route::delete('/administration/meet/deleteMeet/{id}', [App\Http\Controllers\Administration\MeetingsController::class, 'deleteMeet']);
  
  Route::get('/administration/rol/getListRoles', [App\Http\Controllers\Administration\RolesController::class, 'getListRoles']);

  
  //});

Route::get('/{optional?}', function () {
    return view('app');
})->name('basePath')
  ->where('optional', '.*');