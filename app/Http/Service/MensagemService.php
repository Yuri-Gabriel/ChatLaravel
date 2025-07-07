<?php

namespace App\Http\Service;

use App\Models\Mensagem;
use Illuminate\Database\Eloquent\Collection;

class MensagemService {

    public static function getAll(): Collection {
        return Mensagem::all();
    }
    public static function save(Mensagem $mensagem): bool {
        return $mensagem->save();
    }
}
