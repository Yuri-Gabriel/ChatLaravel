<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\MensagemController;
use Illuminate\Support\Facades\Route;

Route::post('/createUser', [UsuarioController::class, 'createUser']);
Route::post('/createGroup', [GrupoController::class, 'createGroup']);

Route::get('/getAllMessages/{nome_grupo}', [MensagemController::class, 'getAll']);
Route::post('/saveMessage/{nome_grupo}', [MensagemController::class, 'saveMessage']);
