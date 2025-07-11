<?php

namespace App\Http\Service;

use App\Models\Grupo;
use App\Models\Mensagem;
use Illuminate\Database\Eloquent\Collection;

class MensagemService {

    public static function getAll(string $nome_grupo): Collection {
        $grupo = Grupo::where("nome_grupo", $nome_grupo)->first();

        return Mensagem::where("id_grupo", $grupo->id_grupo)->get();
    }
    public static function save(Mensagem $mensagem): bool {
        return $mensagem->save();
    }
}
