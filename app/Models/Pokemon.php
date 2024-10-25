<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $table = 'pokemons';
    protected $fillable = ['name', 'type'];

    /**
     * Récupère tous les Pokémons triés par nom.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllSortedByName()
    {
        return self::orderBy('name')->get();
    }

    /**
     * Récupère les Pokémons par type.
     *
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getByType($type)
    {
        return self::where('type', $type)->get();
    }

    /**
     * Vérifie si le Pokémon est de type Plante.
     *
     * @return bool
     */
    public function isPlantType()
    {
        return stripos($this->type, 'Plante') !== false;
    }
}

