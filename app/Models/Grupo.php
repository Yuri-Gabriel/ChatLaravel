<?php

namespace App\Models;

use App\Dto\GrupoDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Grupo extends Model {

    protected $fillable = ['id_grupo', 'nome_grupo'];
    protected $table = "grupo";
    protected $primaryKey = 'id_grupo';

    public static function fromDTO(GrupoDTO $dto): self {
        return new self(['nome_grupo' => $dto->nome_grupo]);
    }

    public function usuarios(): BelongsToMany {
        return $this->belongsToMany(
            Usuario::class,
            'grupo_usuario',
            'id_grupo',
            'id_usuario',
            'id_grupo',
            'id_usuario'
        );
    }
}
