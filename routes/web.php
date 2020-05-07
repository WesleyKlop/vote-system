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
Route::get('/', 'Voter\LoginController@showLoginForm')->name('voter.index');
Route::post('/', 'Voter\LoginController@login')->name('voter.login');
Route::get('/exit', 'Voter\LoginController@logout')->name('voter.logout');

Route::middleware('voter')->group(function () {
    Route::get('/vote', 'Voter\PropositionController@index')->name(
        'proposition.index'
    );
    Route::post('/vote', 'Voter\PropositionController@update')->name(
        'proposition.update'
    );
});

/*
 * Admin area
 */
Route::get('/admin/login', 'Admin\LoginController@showLoginForm')->name(
    'admin.login.show'
);
Route::post('/admin/login', 'Admin\LoginController@login')->name(
    'admin.login.update'
);
Route::get('/admin/logout', 'Admin\LoginController@logout')->name(
    'admin.login.logout'
);

Route::prefix('/admin')
    ->middleware('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', 'Admin\DashboardController@index')->name('index');

        Route::get('/voters', 'Admin\VoterController@index')->name(
            'voters.index'
        );
        Route::post('/voters', 'Admin\VoterController@update')->name(
            'voters.update'
        );
        Route::get(
            '/voters/{voter}/delete',
            'Admin\VoterController@destroy'
        )->name('voters.destroy');

        Route::get('/propositions', 'Admin\PropositionController@index')->name(
            'propositions.index'
        );
        Route::get(
            '/propositions/{proposition}/toggle',
            'Admin\PropositionController@toggle'
        )->name('propositions.toggle');
        Route::resource('propositions', 'Admin\PropositionController')->except(
            'index',
            'show'
        );

        Route::get('/export', 'Admin\ResultExportController@index')->name(
            'export.index'
        );
    });
