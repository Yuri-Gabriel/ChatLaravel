<?php

namespace App\Http\Middleware;

use App\Models\Grupo;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CheckGroup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_session_exists = session()->exists("user_session");

        if(!$user_session_exists) redirect()->route('index-view');

        $nome_grupo = $request->route('nome_grupo');

        $validator = Validator::make([
            "nome_grupo" => $nome_grupo
        ], [
            'nome_grupo' => 'required|string'
        ]);

        if ($validator->fails()) return redirect()->route('group-view');

        $data = $validator->validated();

        $exists = Grupo::where("nome_grupo", $data['nome_grupo'])->exists();

        if(!$exists) redirect()->route('group-view');

        return $next($request);
    }
}
