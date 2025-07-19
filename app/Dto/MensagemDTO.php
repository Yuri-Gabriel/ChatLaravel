<?php

namespace App\Dto;

use App\Models\Mensagem;
use App\Validator\ValidatorRequest;
use Illuminate\Http\Request;

class MensagemDTO {
    public string $texto_mensagem;
    public string $nome_usuario;
    public string $nome_grupo;

    public function __construct(string $texto_mensagem, string $nome_usuario, string $nome_grupo) {
        $this->texto_mensagem = $texto_mensagem;
        $this->nome_usuario = $nome_usuario;
        $this->nome_grupo = $nome_grupo;
    }

    public static function fromModel(Mensagem $mensagem): self {
        return new self(
            $mensagem->texto_mensagem,
            $mensagem->nome_grupo,
            $mensagem->nome_grupo
        );
    }
    public static function fromRequest(Request $request): self {
        return new self(
            $request->input('texto_mensagem'),
            $request->input('nome_usuario'),
            $request->input('nome_grupo')
        );
    }

    public static function requestIsValid(Request $request, array $additional_data = null, array $additional_rules = null): bool {
        $data = array_merge([
            "texto_mensagem" => $request->input('texto_mensagem'),
            "nome_usuario" => $request->input('nome_usuario')
        ], $additional_data == null ? [] : $additional_data);

        $rules = array_merge([
            'texto_mensagem' => 'required|string',
            'nome_usuario' => 'required|string'
        ], $additional_rules == null ? [] : $additional_rules);
        return ValidatorRequest::validate($data, $rules);
    }
}
