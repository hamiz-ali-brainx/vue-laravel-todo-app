<?php

use App\Notifications\NotifyInactiveUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;



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






Route::post('/post-registration', "App\Http\Controllers\RegistrationController@postRegistration")->name('register.post')->middleware(["guest"]);
Route::post('/login/post', "App\Http\Controllers\SessionsController@store")->name('login.post')->middleware(['is_verify_email']);
Route::get('/verification/{token}', 'App\Http\Controllers\RegistrationController@verification')->name('user.verify');




// auth routes
Route::middleware(["auth:sanctum"])->group(function () {
    Route::get('logout', "App\Http\Controllers\SessionsController@destroy")->name('logout');
    Route::get('/todo', "App\Http\Controllers\TodoController@index");
    Route::post('/store-data', "App\Http\Controllers\TodoController@store");
    Route::get('/details/{id}', "App\Http\Controllers\TodoController@details");
    Route::post('update/{id}', "App\Http\Controllers\TodoController@update");
    Route::get('delete/{id}', "App\Http\Controllers\TodoController@delete");
});
