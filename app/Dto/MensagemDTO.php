<?php

namespace App\Dto;

use App\Models\Mensagem;
use App\Validator\ValidatorRequest;
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

    public static function requestIsValid(Request $request, array $additional_data = null, array $additional_rules = null): bool {
        $data = array_merge([
            "texto_mensagem" => $request->input('texto_mensagem'),
            "id_usuario" => $request->input('id_usuario'),
            "id_grupo" => $request->input('id_grupo')
        ], $additional_data == null ? [] : $additional_data);
        
        $rules = array_merge([
            'nome_grupo' => 'required|string',
            'texto_mensagem' => 'required|string',
            'id_usuario' => 'required|numeric',
            'id_grupo' => 'required|numeric'
        ], $additional_rules == null ? [] : $additional_rules);
        return ValidatorRequest::validate($data, $rules);
    }
}
