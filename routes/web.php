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

Route::get('/', function () {
    return view('welcome');
});

//for ADMIN
Route::group(['middleware' => 'auth'], function(){
	Route::resource('perusahaan', 'PerusahaanController');
	Route::resource('jurusan', 'JurusanController');
	Route::resource('berita', 'BeritaController');
	Route::resource('ulasan', 'UlasanController');
});

//for GUEST & API
Route::resource('jurusan', 'JurusanController', ['only' => ['index','show']]);
Route::resource('perusahaan', 'PerusahaanController', ['only' => ['index','show']]);
Route::resource('berita', 'BeritaController', ['only' => ['index','show']]);
Route::resource('ulasan', 'UlasanController', ['only' => ['index','show']]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
