<?php

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

Route::get('/banners', 'BannerController@index')->name('banners.index');
Route::get('/banners/details/{id}', 'BannerController@details')->name('banners.details');
Route::get('/banners/add', 'BannerController@add')->name('banners.add');
Route::post('/banners/insert', 'BannerController@insert')->name('banners.insert');
Route::get('/banners/edit/{id}', 'BannerController@edit')->name('banners.edit');
Route::post('/banners/update/{id}', 'BannerController@update')->name('banners.update');
Route::get('/banners/delete/{id}', 'BannerController@delete')->name('banners.delete');
