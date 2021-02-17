<?php

use App\Http\Controllers\Admin;

use App\Http\Controllers\Voter;
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
Route::get('/', [Voter\LoginController::class, 'showLoginForm'])->name('voter.index');
Route::post('/', [Voter\LoginController::class, 'login'])->name('voter.login');
Route::get('/exit', [Voter\LoginController::class, 'logout'])->name('voter.logout');

Route::middleware('voter')->group(function () {
    Route::get('/vote', [Voter\PropositionController::class, 'index'])->name('proposition.index');
    Route::post('/vote', [Voter\PropositionController::class, 'update'])->name('proposition.update');
});

/*
 * Admin area
 */
Route::get('/admin/login', [Admin\LoginController::class, 'showLoginForm'])->name('admin.login.show');
Route::post('/admin/login', [Admin\LoginController::class, 'login'])->name('admin.login.update');
Route::get('/admin/logout', [Admin\LoginController::class, 'logout'])->name('admin.login.logout');

Route::prefix('/admin')->middleware('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('index');

    Route::get('/voters', [Admin\VoterController::class, 'index'])->name('voters.index');
    Route::post('/voters', [Admin\VoterController::class, 'update'])->name('voters.update');
    Route::get('/voters/{voter}/delete', [Admin\VoterController::class, 'destroy'])->name('voters.destroy');

    Route::get('/propositions', [Admin\PropositionController::class, 'index'])->name('propositions.index');
    Route::get('/propositions/{proposition}/toggle', [Admin\PropositionController::class, 'toggle'])->name('propositions.toggle');
    Route::resource('propositions', Admin\PropositionController::class)->except('index', 'show');

    Route::get('/export', [Admin\ResultExportController::class, 'index'])->name('export.index');

    Route::get('/config', [Admin\AppConfigController::class, 'index'])->name('config.index');
    Route::post('/config', [Admin\AppConfigController::class, 'update'])->name('config.update');
});
