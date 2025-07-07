<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Usuario;
use Database\Factories\UsuarioDtoFactory;
use Illuminate\Http\JsonResponse;

class UsuarioTest extends TestCase {

    use RefreshDatabase;

    public function test_create_one_user(): void {
        $dto = UsuarioDtoFactory::make();

        $usuario = Usuario::fromDTO($dto);
        $usuario->save();

        $this->assertDatabaseHas('usuario', [
            'nome_usuario' => $dto->nome_usuario
        ]);
    }

    public function test_create_multiple_users(): void {
        for ($i = 0; $i < 5; $i++) {
            $dto = UsuarioDTOFactory::make();
            $usuario = Usuario::fromDTO($dto);
            $usuario->save();

            $this->assertDatabaseHas('usuario', [
                'nome_usuario' => $dto->nome_usuario
            ]);
        }
    }

    public function test_create_user_by_request(): void {
        $response = $this->post('/api/createUser', [
            "nome_usuario" => "yuri001"
        ]);

        $response->assertStatus(JsonResponse::HTTP_CREATED);
    }


}
