<?php

namespace App\Models;

use App\Enums\EnumPokemonType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pokemon extends Model
{
    use HasFactory;

    protected $table = 'pokemons';
    protected $fillable = [
        'number',
        'name',
        'image',
        'description',
        'hp',
        'attack',
        'defense',
        'speed',
    ];

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
     * Récupère les types associés au Pokémon.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'pokemon_type', 'pokemon_id', 'type_id');
    }

    /**
     * Récupère la couleur de fond basée sur le premier type du Pokémon.
     *
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return $this->types->isNotEmpty()
            ? EnumPokemonType::from($this->types->first()->name)->getBackgroundColor()
            : 'bg-gray-400';
    }
}

