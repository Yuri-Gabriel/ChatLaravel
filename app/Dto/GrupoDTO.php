<?php

namespace App\Dto;

use App\Models\Grupo;
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
}
