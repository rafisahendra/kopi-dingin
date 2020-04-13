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
    return view('auth/login');
});

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('/home')->group(function(){
    Route::get('/','HomeController@index');  
});

Route::get('/admin/logout', 'HomeController@logout');

Route::prefix('/linimasa')->group(function(){
    Route::get('/data','LinimasaConrtoller@index');
    Route::post('/tambah','LinimasaConrtoller@store');
    Route::get('/edit/{id}','LinimasaConrtoller@edit');
    Route::put('/edit','LinimasaConrtoller@update');
    Route::delete('/delete/{id}/{gambar}','LinimasaConrtoller@destroy');
    // Route::put('/edit/{id}','LinimasaConrtoller@update'); Jika method put membawa parameter ID
});


Route::prefix('/kategori')->group( function(){
    Route::get('/data','KategoriController@view');
    Route::post('/tambah','KategoriController@store');
    Route::get('/edit/{id}', 'KategoriController@edit');
    Route::put('/edit','KategoriController@update');
    Route::delete('/delete/{id}','KategoriController@destroy');
});


Route::prefix('/berita')->group(function(){
    Route::get('/data','BeritaController@view');
    Route::post('/tambah','BeritaController@store');
    Route::delete('/delete/{id}','BeritaController@destroy');
});