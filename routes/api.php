<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\GameController;

Route::middleware(['auth:sanctum', 'x.authorization'])->group(function () {
    Route::apiResource('players', PlayerController::class);
    Route::apiResource('teams', TeamController::class);
    Route::apiResource('games', GameController::class);
});
