<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BotController;

Route::post('api/bot/vraag', [BotController::class, 'vraag']);





