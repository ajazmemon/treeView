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
Auth::routes();
Route::group(['middleware' => ['auth']], function() {
Route::get('category-tree-view','CategoryController@manageCategory');
Route::post('add_category','CategoryController@addCategory')->name('add.category');
Route::post('update_category/{updateId}','CategoryController@updateCategory')->name('update.category');

Route::get('category','CategoryController@index');
Route::get('categoryData','CategoryController@categoryData');
Route::get('categoryEdit/{edit}','CategoryController@categoryEdit');
Route::get('categoryDestroy/{delete}','CategoryController@categoryDestroy')->name('categoryDestroy');
});
Route::get('/home', 'HomeController@index')->name('home');

