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

/*
 * Voter area
 */
Route::get('/', 'IndexController@index')->name('index');
Route::post('/', 'IndexController@register')->name('index.register');

Route::middleware('voter')->group(function () {
    Route::get('/vote', 'VoteController@index')->name('vote.index');
    Route::get('/vote/{vote}', 'VoteController@show')->name('vote.show');
});

/*
 * Admin area
 */
Route::get('/admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login.show');
Route::post('/admin/login', 'Admin\LoginController@login')->name('admin.login.update');
Route::get('/admin/logout', 'Admin\LoginController@logout')->name('admin.login.logout');

Route::prefix('/admin')->middleware('admin')->group(function () {
    Route::get('/', function () {
        dump(Auth::user());
    })->name('admin.index');


    Route::get('/tokens', 'Admin\TokenController@index')->name('admin.tokens.index');
    Route::post('/tokens', 'Admin\TokenController@update')->name('admin.tokens.update');
});
