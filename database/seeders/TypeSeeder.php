<?php

namespace Database\Seeders;

use App\Enums\EnumPokemonType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = EnumPokemonType::values();
        
        foreach ($types as $type) {
            DB::table('types')->insert([
                'name' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 