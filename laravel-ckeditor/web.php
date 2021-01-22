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

Route::get('/setting/mail-Formate', 'setting\PdfsettingController@settingpdf1')->name('settingpdf1');
Route::post('ckeditor/upload', 'setting\PdfsettingController@upload')->name('ckeditor.upload');



