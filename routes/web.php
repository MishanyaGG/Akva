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

/************************
     ГЛАВНАЯ СТРАНИЦА
************************/

Route::get('/', 'MainController@index')->name('index');

/*************************************
     Страница вывода некоторых ошибок
**************************************/

Route::get('/error','MainController@error')->name('error');

/***************************************
    Страница для обработки регистрации
****************************************/

Route::post('/reg','MainController@register')->name('register');

/*****************************************
    Страница для обработки входа в профиль
******************************************/

Route::match(['get','post'],'/login','MainController@login')->name('login');

/************************
     СТРАНИЦА КОНТАКТЫ
************************/

Route::get('/contacts','MainController@contact')->name('contact');

/************************
     СТРАНИЦА ПРОФИЛЬ
************************/

Route::get('/profile','MainController@profile')->name('profile');

/***********************************
     СТРАНИЦА ДЛЯ ВЫХОДА ИЗ ПРОФИЛЯ
*************************************/

Route::get('/leave','MainController@leave')->name('leave');
