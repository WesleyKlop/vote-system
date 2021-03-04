<?php

use App\Http\Controllers\Voter;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api-voter')->group(function () {
    Route::post('propositions/{proposition}/vote', [Voter\PropositionVotesController::class, 'store'])->name('api.proposition.votes.store');
});
