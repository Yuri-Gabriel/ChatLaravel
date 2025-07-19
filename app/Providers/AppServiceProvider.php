<?php

namespace App\Providers;

use App\Models\Grupo;
use App\Models\Mensagem;
use App\Models\Usuario;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
