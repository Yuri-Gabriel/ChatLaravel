<?php

namespace App\Http\Controllers;

use App\Dto\MensagemDTO;
use App\Events\MensagemEvent;
use App\Http\Service\MensagemService;
use App\Models\Mensagem;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MensagemController extends Controller {
    public function saveMessage(Request $request, string $nome_grupo): JsonResponse {
        try {

            $requestIsValid = MensagemDTO::requestIsValid(
                $request,
                ['nome_grupo' => $nome_grupo],
                ['nome_grupo' => 'required|string']
            );

            if (!$requestIsValid) return response()->json([
                'success' => false,
                'message' => 'Dados inválidos'
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

            $mensagemDto = MensagemDTO::fromRequest($request);

            $saved = MensagemService::save(
                Mensagem::fromDTO($mensagemDto)
            );

            if (!$saved) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao salvar a mensagem'
                ], JsonResponse::HTTP_BAD_REQUEST);
            }

            broadcast(new MensagemEvent($mensagemDto));
            return response()->json([
                'success' => true,
                'message' => 'Mensagem criada com sucesso'
            ], JsonResponse::HTTP_CREATED);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => $err->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
