<?php

namespace App\Http\Service;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

class UsuarioService {

    public static function save(Usuario $user): bool {
        return $user->save();
    }
}
