<?php

namespace App\Http\Controllers;

use App\Enums\EnumPokemonType;
use App\Models\Pokemon;

class PokemonShowController extends Controller
{
    /**
     * Affiche la liste des Pokémons.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pokemons = Pokemon::with('types')
            ->get()
            ->map(function ($pokemon) {
                $pokemon->backgroundColor = $pokemon->getBackgroundColor();
                return $pokemon;
            });

        return view('pokemons.index', [
            'pokemons' => $pokemons,
        ]);
    }

    /**
     * Montre le formulaire pour créer un nouveau Pokémon.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $types = EnumPokemonType::values();
        return view('pokemons.create', compact('types'));
    }

    /**
     * Affiche les détails d'un Pokémon.
     *
     * @param int $pokemonId
     * @return \Illuminate\View\View
     */
    public function show($pokemonId)
    {
        $pokemon = Pokemon::with('types')->findOrFail($pokemonId);
        $pokemon->backgroundColor = $pokemon->getBackgroundColor();
        return view('pokemons.show', compact('pokemon'));
    }

    /**
     * Affiche le formulaire pour éditer un Pokémon.
     *
     * @param int $pokemonId
     * @return \Illuminate\View\View
     */
    public function edit($pokemonId)
    {
        $pokemon = Pokemon::with('types')->findOrFail($pokemonId);
        $types = EnumPokemonType::values();
        return view('pokemons.edit', compact('pokemon', 'types'));
    }
}
