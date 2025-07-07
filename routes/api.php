<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\MensagemController;
use Illuminate\Support\Facades\Route;

Route::post('/createUser', [UsuarioController::class, 'createUser']);
Route::post('/createGroup', [GrupoController::class, 'createGroup']);
Route::post('/saveMessage', [MensagemController::class, 'saveMessage']);
