<?php

namespace Tests\Feature;

use App\Models\Grupo;
use App\Models\Mensagem;
use App\Models\Usuario;
use Database\Factories\GrupoDtoFactory;
use Database\Factories\MensagemDtoFactory;
use Database\Factories\UsuarioDtoFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class MensagemTest extends TestCase {
    use RefreshDatabase;

    public function test_get_all_messages(): void {

        $grupoDto = GrupoDtoFactory::make();
        $grupo = Grupo::fromDTO($grupoDto);
        $grupo->save();

        for($i = 0; $i < 5; $i++) {
            $usuarioDto = UsuarioDtoFactory::make();
            $usuario = Usuario::fromDTO($usuarioDto);
            $usuario->save();

            $dto = MensagemDtoFactory::make([
                'id_usuario' => $usuario->id_usuario,
                'id_grupo' => $grupo->id_grupo
            ]);

            $mensagem = Mensagem::fromDTO($dto);
            $mensagem->save();
        }

        $reponse = $this->get("/api/getAllMessages/" . $grupo->nome_grupo);

        $reponse->assertStatus(JsonResponse::HTTP_OK);
    }

    public function test_create_one_message(): void {
        $usuarioDto = UsuarioDtoFactory::make();
        $usuario = Usuario::fromDTO($usuarioDto);
        $usuario->save();

        $grupoDto = GrupoDtoFactory::make();
        $grupo = Grupo::fromDTO($grupoDto);
        $grupo->save();

        $dto = MensagemDtoFactory::make([
            'id_usuario' => $usuario->id_usuario,
            'id_grupo' => $grupo->id_grupo
        ]);

        $mensagem = Mensagem::fromDTO($dto);
        $mensagem->save();

        $this->assertDatabaseHas('mensagem', [
            'texto_mensagem' => $dto->texto_mensagem,
            'id_usuario' => $dto->id_usuario,
            'id_grupo' => $dto->id_grupo
        ]);
    }

    public function test_create_multiple_messages(): void {
        for ($i = 0; $i < 5; $i++) {
            $usuarioDto = UsuarioDtoFactory::make();
            $usuario = Usuario::fromDTO($usuarioDto);
            $usuario->save();

            $grupoDto = GrupoDtoFactory::make();
            $grupo = Grupo::fromDTO($grupoDto);
            $grupo->save();

            $dto = MensagemDtoFactory::make([
                'id_usuario' => $usuario->id_usuario,
                'id_grupo' => $grupo->id_grupo
            ]);
            $mensagem = Mensagem::fromDTO($dto);
            $mensagem->save();

            $this->assertDatabaseHas('mensagem', [
                'texto_mensagem' => $dto->texto_mensagem,
                'id_usuario' => $dto->id_usuario,
                'id_grupo' => $dto->id_grupo
            ]);
        }
    }

    public function test_create_message_by_request(): void {

        Event::fake();

        $usuarioDto = UsuarioDtoFactory::make();
        $usuario = Usuario::fromDTO($usuarioDto);
        $usuario->save();

        $grupoDto = GrupoDtoFactory::make();
        $grupo = Grupo::fromDTO($grupoDto);
        $grupo->save();

        $dto = MensagemDtoFactory::make([
            'id_usuario' => $usuario->id_usuario,
            'id_grupo' => $grupo->id_grupo
        ]);

        $response = $this->postJson(
            '/api/saveMessage/' . str_replace(" ", "", $grupo->nome_grupo),
            (array) $dto

        );

        $response->assertStatus(JsonResponse::HTTP_CREATED);
    }
}
