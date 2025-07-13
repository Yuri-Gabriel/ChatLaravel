<?php

namespace App\Http\Controllers;

use App\Dto\GrupoDTO;
use App\Exceptions\GrupoException;
use App\Http\Service\GrupoService;
use App\Models\Grupo;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller {

    // Criar o getAll
    public function createGroup(Request $request): JsonResponse {
        try {
            $requestIsValid = GrupoDTO::requestIsValid(
                $request
            );

            if (!$requestIsValid) return response()->json([
                'success' => false,
                'message' => 'Dados inválidos'
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            

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
        } catch (GrupoException $err) {
            return response()->json([
                'success' => false,
                'message' => $err->getMessage()
            ], JsonResponse::HTTP_NOT_ACCEPTABLE);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => $err->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
