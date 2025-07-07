<?php

namespace Database\Factories;

use App\Dto\MensagemDTO;
use App\Dto\UsuarioDTO;
use Faker\Factory;

class MensagemDtoFactory  {
    public static function make(array $override = []): MensagemDTO
    {
        $faker = Factory::create();

        $texto = $override['texto_mensagem'] ?? $faker->text();
        $id_usuario = $override['id_usuario'] ?? $faker->numberBetween();
        $id_grupo = $override['id_grupo'] ?? $faker->numberBetween();


        return new MensagemDTO(
            $texto,
            $id_usuario,
            $id_grupo
        );
    }
}
