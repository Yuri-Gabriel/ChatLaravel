<?php

namespace Database\Factories;

use App\Dto\UsuarioDTO;
use Faker\Factory;

class UsuarioDtoFactory  {
    public static function make(array $override = []): UsuarioDTO
    {
        $faker = Factory::create();

        $nome = $override['nome_usuario'] ?? $faker->name;

        return new UsuarioDTO($nome);
    }
}
