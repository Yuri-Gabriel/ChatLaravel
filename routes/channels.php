<?php

use App\Events\MensagemEvent;
use App\Models\Grupo;
use App\Models\Usuario;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel("chat.{nomeGrupo}", function (Usuario $user, string $nomeGrupo): bool {
    $grupo = Grupo::where('nome_grupo', $nomeGrupo)->first();

    if (!$grupo) return false;

    return $user->grupos()->where('id_grupo', $grupo->id_grupo)->exists();
});
