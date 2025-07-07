<?php

namespace Tests\Feature;

use App\Models\Grupo;
use App\Models\Usuario;
use Database\Factories\GrupoDtoFactory;
use Database\Factories\UsuarioDtoFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class GrupoTest extends TestCase {
    use RefreshDatabase;

    public function test_create_one_group(): void {
        $dto = GrupoDtoFactory::make();

        $grupo = Grupo::fromDTO($dto);
        $grupo->save();

        $this->assertDatabaseHas('grupo', [
            'nome_grupo' => $dto->nome_grupo
        ]);
    }

    public function test_create_multiple_groups(): void {
        for ($i = 0; $i < 5; $i++) {
            $dto = GrupoDtoFactory::make();
            $grupo = Grupo::fromDTO($dto);
            $grupo->save();

            $this->assertDatabaseHas('grupo', [
                'nome_grupo' => $dto->nome_grupo
            ]);
        }
    }

    public function test_create_group_by_request(): void {
        $response = $this->post('/api/createGroup', [
            "nome_grupo" => "prateados"
        ]);

        $response->assertStatus(JsonResponse::HTTP_CREATED);
    }

    public function test_user_join_in_group(): void {
        $usuarioDto = UsuarioDtoFactory::make();
        $usuario = Usuario::fromDTO($usuarioDto);
        $usuario->save();

        $grupoDto = GrupoDtoFactory::make();
        $grupo = Grupo::fromDTO($grupoDto);
        $grupo->save();

        $grupo->usuarios()->attach($usuario->id_usuario);

        $exist = $grupo->usuarios()->where(
            'usuario.id_usuario',
            $usuario->id_usuario
        )->exists();

        $this->assertTrue($exist);
    }
}
