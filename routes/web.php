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
session_start();

Route::get('/', 'MainController@index')->name('index');

Route::post('/reg','MainController@register')->name('register');

Route::post('/login','MainController@login')->name('login');

Route::get('/contacts','MainController@contact')->name('contact');

Route::get('/leave','MainController@leave')->name('leave');
