<?php

namespace App\Dto;

use App\Models\Grupo;
use App\Validator\ValidatorRequest;
use Illuminate\Http\Request;

class GrupoDTO {
    public string $nome_grupo;

    public function __construct(string $nome_grupo) {
        $this->nome_grupo = $nome_grupo;
    }

    public static function fromModel(Grupo $grupo): self {
        return new self($grupo->nome_grupo);
    }
    public static function fromRequest(Request $request): self {
        return new self($request->input('nome_grupo'));
    }

    public static function requestIsValid(Request $request, array $additional_data = null, array $additional_rules = null): bool {
        $data = array_merge([
            "nome_grupo" => $request->input('nome_grupo')
        ], $additional_data == null ? [] : $additional_data);

        $rules = array_merge([
            'nome_grupo' => 'required|string'
        ], $additional_rules == null ? [] : $additional_rules);
        return ValidatorRequest::validate($data, $rules);
    }

}
