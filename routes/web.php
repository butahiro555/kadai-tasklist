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

//コントローラ名はTasksControllerとする
Route::get('/', 'TasksController@index');

//今回の課題ではresourceを使用する
Route::resource('tasks', 'TasksController');