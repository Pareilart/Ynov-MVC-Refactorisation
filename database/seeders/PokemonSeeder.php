<?php

namespace Database\Seeders;

use App\Models\Pokemon;
use App\Models\Type;
use Illuminate\Database\Seeder;

class PokemonSeeder extends Seeder
{
    public function run(): void
    {
        $pokemonData = [
            ['number' => "0001", 'name' => 'Bulbizarre', 'types' => ['Plante', 'Poison'], 'hp' => 40, 'attack' => 49, 'defense' => 49, 'speed' => 45],
            ['number' => "0002", 'name' => 'Herbizarre', 'types' => ['Plante', 'Poison'], 'hp' => 60, 'attack' => 62, 'defense' => 63, 'speed' => 60],
            ['number' => "0003", 'name' => 'Florizarre', 'types' => ['Plante', 'Poison'], 'hp' => 80, 'attack' => 82, 'defense' => 83, 'speed' => 80],
            ['number' => "0004", 'name' => 'Salamèche', 'types' => ['Feu'], 'hp' => 39, 'attack' => 52, 'defense' => 43, 'speed' => 65],
            ['number' => "0005", 'name' => 'Reptincel', 'types' => ['Feu'], 'hp' => 58, 'attack' => 64, 'defense' => 58, 'speed' => 80],
            ['number' => "0006", 'name' => 'Dracaufeu', 'types' => ['Feu', 'Vol'], 'hp' => 78, 'attack' => 84, 'defense' => 78, 'speed' => 100],
            ['number' => "0007", 'name' => 'Carapuce', 'types' => ['Eau'], 'hp' => 44, 'attack' => 48, 'defense' => 65, 'speed' => 43],
            ['number' => "0008", 'name' => 'Carabaffe', 'types' => ['Eau'], 'hp' => 59, 'attack' => 63, 'defense' => 80, 'speed' => 58],
            ['number' => "0009", 'name' => 'Tortank', 'types' => ['Eau'], 'hp' => 79, 'attack' => 83, 'defense' => 100, 'speed' => 78],
            ['number' => "0010", 'name' => 'Chenipan', 'types' => ['Insecte'], 'hp' => 45, 'attack' => 30, 'defense' => 35, 'speed' => 45],
        ];

        foreach ($pokemonData as $data) {
            // Créer le Pokémon
            $pokemon = Pokemon::create([
                'name' => $data['name'],
                'number' => $data['number'],
                'hp' => $data['hp'],
                'attack' => $data['attack'],
                'defense' => $data['defense'],
                'speed' => $data['speed'],
            ]);

            // Récupérer les IDs des types
            $typeIds = Type::whereIn('name', $data['types'])->pluck('id');

            // Associer les types au Pokémon
            $pokemon->types()->attach($typeIds);
        }
    }
}

