<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    /**
     * Affiche la liste des Pokémons.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pokemons = Pokemon::all();
        return view('pokemons.index', compact('pokemons'));
    }

    /**
     * Montre le formulaire pour créer un nouveau Pokémon.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pokemons.create');
    }

    /**
     * Stocke un nouveau Pokémon dans la base de données.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        Pokemon::create($request->only(['name', 'type']));
        return redirect()->route('pokemons.index')->with('success', 'Pokémon créé avec succès !');
    }

    /**
     * Affiche les détails d'un Pokémon.
     *
     * @param Pokemon $pokemon
     * @return \Illuminate\View\View
     */
    public function show(Pokemon $pokemon)
    {
        return view('pokemons.show', compact('pokemon'));
    }

    /**
     * Montre le formulaire pour éditer un Pokémon.
     *
     * @param Pokemon $pokemon
     * @return \Illuminate\View\View
     */
    public function edit(Pokemon $pokemon)
    {
        return view('pokemons.edit', compact('pokemon'));
    }

    /**
     * Met à jour un Pokémon dans la base de données.
     *
     * @param \Illuminate\Http\Request $request
     * @param Pokemon $pokemon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Pokemon $pokemon)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $pokemon->update($request->only(['name', 'type']));
        return redirect()->route('pokemons.index')->with('success', 'Pokémon mis à jour avec succès !');
    }

    /**
     * Supprime un Pokémon de la base de données.
     *
     * @param Pokemon $pokemon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();
        return redirect()->route('pokemons.index')->with('success', 'Pokémon supprimé avec succès !');
    }
}

