<?php

namespace App\Http\Controllers;

use App\Dto\GrupoDTO;
use App\Http\Service\GrupoService;
use App\Models\Grupo;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GrupoController extends Controller {
    public function createGroup(Request $request): JsonResponse {
        try {
            $grupoDto = GrupoDTO::fromRequest($request);

            $saved = GrupoService::save(
                Grupo::fromDTO($grupoDto)
            );

            if (!$saved) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao criar o grupo'
                ], JsonResponse::HTTP_BAD_REQUEST);
            }

            return response()->json([
                'success' => true,
                'message' => 'Grupo criado com sucesso'
            ], JsonResponse::HTTP_CREATED);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => $err->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
