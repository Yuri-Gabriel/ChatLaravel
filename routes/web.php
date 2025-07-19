<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\MensagemController;
use App\Http\Controllers\ViewController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

Route::prefix('view')->group(function (): void {
    Route::get('/', function (): View {
        return view('index');
    })->name('index-view');

    Route::get('/group', [ViewController::class, 'groupSelectionView'])
    ->name("group-view")
    ->middleware("check-user");

    Route::get(
        'chat/{nome_grupo}',
        [ViewController::class, 'accessChat']
    )
    ->name("chat-view")
    ->middleware('check-group');
});

Route::prefix('api')->group(function (): void {
    Route::post(
    '/createUser',
    [UsuarioController::class, 'createUser']
    );
    Route::post(
        '/createGroup',
        [GrupoController::class, 'createGroup']
    );
    Route::post(
        '/saveMessage/{nome_grupo}',
        [MensagemController::class, 'saveMessage']
    );
});

Route::fallback(function (): RedirectResponse {
    return redirect()->route('index-view');
});

