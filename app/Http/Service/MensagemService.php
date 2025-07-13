<?php

namespace App\Http\Service;

use App\Exceptions\MensagemException;
use App\Models\Grupo;
use App\Models\Mensagem;
use Illuminate\Database\Eloquent\Collection;

class MensagemService {

    public static function save(Mensagem $mensagem): bool {
        return $mensagem->save();
    }
}
