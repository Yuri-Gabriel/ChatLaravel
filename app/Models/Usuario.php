<?php

namespace App\Models;

use App\Dto\UsuarioDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Usuario extends Model
{
    protected $fillable = ['nome_usuario'];
    protected $table = "usuario";
    protected $primaryKey = 'id_usuario';

    public static function fromDTO(UsuarioDTO $dto): self {
        return new self(['nome_usuario' => $dto->nome_usuario]);
    }

    public function grupos(): BelongsToMany {
        return $this->belongsToMany(
            Grupo::class,
            'grupo_usuario',
            'id_usuario',
            'id_grupo',
            'id_usuario',
            'id_grupo'
        );
    }
}
