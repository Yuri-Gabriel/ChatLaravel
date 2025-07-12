<?php

namespace App\Http\Service;

use App\Exceptions\GrupoException;
use App\Models\Grupo;
use Illuminate\Database\Eloquent\Collection;

class GrupoService {

    public static function getAll(): Collection {
        return Grupo::all();
    }
    public static function save(Grupo $grupo): bool {

        $alreadyExist = Grupo::where('nome_grupo', $grupo->nome_grupo)->exists();

        if($alreadyExist) throw new GrupoException(
            "The group '$grupo->nome_grupo' already exist"
        );

        return $grupo->save();
    }
}
