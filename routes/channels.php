<?php

use App\Dto\MensagemDTO;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel("chat.{nomeGrupo}", function ($user, $nomeGrupo) {
    Log::debug("Broadcast::channel: " . $nomeGrupo);
    return [
        'nomeGrupo' => $nomeGrupo
    ];
});
