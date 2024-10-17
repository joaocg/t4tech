<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TestBallDontLieController;
use App\Http\Controllers\UserAuthController;

Route::post('register',[UserAuthController::class, 'register']);
Route::post('login',[UserAuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'x.authorization'])->group(function () {
    Route::apiResource('players', PlayerController::class)->except('destroy');
    Route::delete('players/{user}', [PlayerController::class, 'destroy'])->middleware('admin');

    Route::apiResource('teams', TeamController::class);
    Route::delete('teams/{user}', [TeamController::class, 'destroy'])->middleware('admin');

    Route::apiResource('games', GameController::class);
    Route::delete('games/{user}', [GameController::class, 'destroy'])->middleware('admin');

});
