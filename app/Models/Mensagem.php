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
        return new self([
            'texto_mensagem' => $dto->texto_mensagem,
            'id_usuario' => $dto->id_usuario,
            'id_grupo' => $dto->id_grupo
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
