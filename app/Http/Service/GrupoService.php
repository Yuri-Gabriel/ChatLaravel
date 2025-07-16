<?php

namespace App\Http\Service;

use App\Models\Grupo;
use Illuminate\Database\Eloquent\Collection;

class GrupoService {

    public static function getAll(): Collection {
        return Grupo::all();
    }
    public static function save(Grupo $grupo): bool {
        return $grupo->save();
    }
}
