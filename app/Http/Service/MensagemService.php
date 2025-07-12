<?php

namespace App\Http\Service;

use App\Exceptions\MensagemException;
use App\Models\Grupo;
use App\Models\Mensagem;
use Illuminate\Database\Eloquent\Collection;

class MensagemService {

    public static function getAll(string $nome_grupo): Collection {
        $grupo = Grupo::where("nome_grupo", $nome_grupo)->first();

        if($grupo == null) throw new MensagemException(
            "The '$nome_grupo' group does not exist"
        );

        return Mensagem::where("id_grupo", $grupo->id_grupo)->get();
    }
    public static function save(Mensagem $mensagem): bool {
        return $mensagem->save();
    }
}
