<?php

namespace App\Models;

use App\Dto\MensagemDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mensagem extends Model {
    protected $fillable = [
        'texto_mensagem',
        'id_usuario',
        'id_grupo'
    ];
    protected $table = "mensagem";
    protected $primaryKey = 'id_mensagem';

    public static function fromDTO(MensagemDTO $dto): self {
        $idUsuario = Usuario::where('nome_usuario', $dto->nome_usuario)->value('id_usuario');
        $idGrupo = Grupo::where('nome_grupo', $dto->nome_grupo)->value('id_grupo');

        if (!$idUsuario || !$idGrupo) {
            throw new \Exception('Usuário ou grupo não encontrado');
        }

        return new self([
            'texto_mensagem' => $dto->texto_mensagem,
            'id_usuario' => $idUsuario,
            'id_grupo' => $idGrupo,
        ]);
    }

    public function grupo(): BelongsTo {
        return $this->belongsTo(
            Grupo::class,
            'id_grupo'
        );
    }

    public function usuario(): BelongsTo {
        return $this->belongsTo(
            Usuario::class,
            'id_usuario'
        );
    }
}
