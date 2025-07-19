<?php

use App\Models\Grupo;
use App\Models\Mensagem;
use App\Models\Usuario;
use Illuminate\Support\Facades\Artisan;

Artisan::command("showGroups", function(): void {
    $grupos = Mensagem::get();
    echo "usuarios\n";
    var_dump($grupos);
});
