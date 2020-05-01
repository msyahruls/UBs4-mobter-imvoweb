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
    return view('auth.login');
});

//for ADMIN
Route::group(['middleware' => 'auth'], function()
{
	Route::resource('dashboard', 'DashboardController');
	Route::resource('jurusan', 'JurusanController');
	Route::resource('perusahaan', 'PerusahaanController');
	Route::resource('ulasan', 'UlasanController');
	Route::resource('berita', 'BeritaController');

	Route::get('export_jurusan', 'JurusanController@export_excel');
	Route::get('export_perusahaan', 'PerusahaanController@export_excel');
	Route::get('export_ulasan', 'UlasanController@export_excel');
	Route::get('export_berita', 'BeritaController@export_excel');
});

//for GUEST & API
Route::resource('jurusan', 'JurusanController', ['only' => ['index','show']]);
Route::resource('perusahaan', 'PerusahaanController', ['only' => ['index','show']]);
Route::resource('berita', 'BeritaController', ['only' => ['index','show']]);
Route::resource('ulasan', 'UlasanController', ['only' => ['index','show']]);

Auth::routes();
Route::get('/home', 'DashboardController@index')->name('home');

