<?php

namespace App\Dto;

use App\Models\Mensagem;
use Illuminate\Http\Request;

class MensagemDTO {
    public string $texto_mensagem;
    public int $id_usuario;
    public int $id_grupo;

    public function __construct(string $texto_mensagem, int $id_usuario, int $id_grupo) {
        $this->texto_mensagem = $texto_mensagem;
        $this->id_usuario = $id_usuario;
        $this->id_grupo = $id_grupo;
    }

    public static function fromModel(Mensagem $mensagem): self {
        return new self(
            $mensagem->texto_mensagem,
            $mensagem->id_usuario,
            $mensagem->id_grupo
        );
    }
    public static function fromRequest(Request $request): self {
        return new self(
            $request->input('texto_mensagem'),
            $request->input('id_usuario'),
            $request->input('id_grupo')
        );
    }
}
