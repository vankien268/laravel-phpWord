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

Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@show');
//Route::get('users/word-export/{id}', 'UserController@wordExport');
//Route::get('users/word-export/{id}', 'UserController@wordExportHtml');
//Route::get('users/word-export/{id}', 'UserController@wordExportHtmlForUser');
//Route::get('users/word-export/{id}', 'UserController@wordExportPdfForUser');
Route::get('users/word-export/{id}', 'UserController@wordExportPdfForUser2');
