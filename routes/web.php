<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth'])->group(function() {

    // list all categories, add new category, delete category
    Route::get('categories', 'App\Http\Controllers\CategoryController@index')->name('categories.index');
    Route::get('categories/form', 'App\Http\Controllers\CategoryController@create')->name('categories.form');
    Route::post('categories', 'App\Http\Controllers\CategoryController@store')->name('categories.add');
    Route::get('categories/remove/{categoryId}', 'App\Http\Controllers\CategoryController@destroy')->name('categories.remove');
    Route::get('categories/edit/{categoryId}', 'App\Http\Controllers\CategoryController@edit')->name('categories.edit');
    Route::post('categories/update', 'App\Http\Controllers\CategoryController@update')->name('categories.update');

    // list all tags, add new tag, delete tag
    Route::get('tags', 'App\Http\Controllers\TagController@index')->name('tags.index');
    Route::get('tags/form', 'App\Http\Controllers\TagController@create')->name('tags.form');
    Route::post('tags', 'App\Http\Controllers\TagController@store')->name('tags.add');
    Route::get('tags/remove/{tagId}', 'App\Http\Controllers\TagController@destroy')->name('tags.remove');
    Route::get('tags/edit/{tagId}', 'App\Http\Controllers\TagController@edit')->name('tags.edit');
    Route::post('tags/update', 'App\Http\Controllers\TagController@update')->name('tags.update');
});

Auth::routes();
