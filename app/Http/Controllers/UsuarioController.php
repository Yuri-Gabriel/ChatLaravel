<?php

namespace App\Http\Controllers;

use App\Dto\UsuarioDTO;
use App\Http\Service\UsuarioService;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsuarioController extends Controller {

    public function createUser(Request $request): JsonResponse {
        try {
            $usuarioDTO = UsuarioDTO::fromRequest($request);

            $saved = UsuarioService::save(
                Usuario::fromDTO($usuarioDTO)
            );

            if (!$saved) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao salvar usuário'
                ], JsonResponse::HTTP_BAD_REQUEST);
            }

            return response()->json([
                'success' => true,
                'message' => 'Usuário salvo com sucesso'
            ], JsonResponse::HTTP_CREATED);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => $err->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
