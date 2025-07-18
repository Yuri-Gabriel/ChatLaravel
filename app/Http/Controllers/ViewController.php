<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Mensagem;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ViewController extends Controller
{
    public function accessChat(string $nome_grupo): View {
        $grupo = Grupo::where("nome_grupo", $nome_grupo)->first();

        $mensagens = Mensagem::get("mensagem.id_grupo", $grupo->id_grupo)->all();

        return view('chat', [
            "messages" => $mensagens
        ]);
    }

    public function groupSelectionView(): View {
        $grupos = Grupo::get()->all();

        return view('group', [
            "groups" => $grupos
        ]);
    }
}
