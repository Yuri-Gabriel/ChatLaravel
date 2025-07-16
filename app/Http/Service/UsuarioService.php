<?php

namespace App\Http\Service;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

class UsuarioService {

    public static function save(Usuario $user): bool {
        $exist = Usuario::where('nome_usuario', $user->nome_usuario)->exists();
        if($exist) return true;
        
        return $user->save();
    }
}
