<?php

namespace Tests\Feature;

use App\Events\MensagemEvent;
use App\Models\Grupo;
use App\Models\Usuario;
use Database\Factories\GrupoDtoFactory;
use Database\Factories\MensagemDtoFactory;
use Database\Factories\UsuarioDtoFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class WebsocketTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_websocket(): void
    {
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
            "api/saveMessage/" . str_replace(" ", "", $grupo->nome_grupo),
            (array) $dto
        );

        Event::assertDispatched(
            MensagemEvent::class,
            function ($event) use ($dto, $grupo): bool {
                return $event->dto->texto_mensagem == $dto->texto_mensagem;
        });
    }
}
