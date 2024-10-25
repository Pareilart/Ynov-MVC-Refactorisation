<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pokemons')->insert([
            ['name' => 'Bulbizarre', 'type' => 'Plante/Poison'],
            ['name' => 'Herbizarre', 'type' => 'Plante/Poison'],
            ['name' => 'Florizarre', 'type' => 'Plante/Poison'],
            ['name' => 'Salamèche', 'type' => 'Feu'],
            ['name' => 'Reptincel', 'type' => 'Feu'],
            ['name' => 'Dracaufeu', 'type' => 'Feu/Vol'],
            ['name' => 'Carapuce', 'type' => 'Eau'],
            ['name' => 'Carabaffe', 'type' => 'Eau'],
            ['name' => 'Tortank', 'type' => 'Eau'],
            ['name' => 'Chenipan', 'type' => 'Insecte'],
        ]);
    }
}

