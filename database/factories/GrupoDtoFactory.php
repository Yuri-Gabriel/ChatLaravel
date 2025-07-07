<?php

namespace Database\Factories;

use App\Dto\GrupoDTO;
use Faker\Factory;

class GrupoDtoFactory  {
    public static function make(array $override = []): GrupoDTO
    {
        $faker = Factory::create();

        $nome = $override['nome_grupo'] ?? $faker->name;

        return new GrupoDTO($nome);
    }
}
