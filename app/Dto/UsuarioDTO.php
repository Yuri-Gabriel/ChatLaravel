<?php

namespace App\Dto;

use App\Models\Usuario;
use App\Validator\ValidatorRequest;
use Illuminate\Http\Request;

class UsuarioDTO {
    public string $nome_usuario;

    public function __construct(string $nome_usuario) {
        $this->nome_usuario = $nome_usuario;
    }

    public static function fromModel(Usuario $user): self {
        return new self($user->nome_usuario);
    }
    public static function fromRequest(Request $request): self {
        return new self($request->input('nome_usuario'));
    }

    public static function requestIsValid(Request $request, array $additional_data = null, array $additional_rules = null): bool {
        $data = array_merge([
            "nome_usuario" => $request->input('nome_usuario')
        ], $additional_data == null ? [] : $additional_data);

        $rules = array_merge([
            'nome_usuario' => 'required|string'
        ], $additional_rules == null ? [] : $additional_rules);
        return ValidatorRequest::validate($data, $rules);
    }
}
