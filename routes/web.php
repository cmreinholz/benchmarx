<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;

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
Auth::routes(['verify' => true,
    'register' => true,
]);
Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard')->middleware('auth');

Route::post('dashboard', 'DashboardController@response')->middleware('auth');

Route::get('/home', 'DashboardController@dashboard')->name('home')->middleware('auth');

Route::resource('questions', 'QuestionController')->middleware('auth');


