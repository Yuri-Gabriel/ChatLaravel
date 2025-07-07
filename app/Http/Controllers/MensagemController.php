<?php

namespace App\Http\Controllers;

use App\Dto\MensagemDTO;
use App\Http\Service\MensagemService;
use App\Models\Mensagem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MensagemController extends Controller {
    public function saveMessage(Request $request): JsonResponse {
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

        return response()->json([
            'success' => true,
            'message' => 'Mensagem criada com sucesso'
        ], JsonResponse::HTTP_CREATED);
    }
}
