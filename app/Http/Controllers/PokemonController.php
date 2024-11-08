<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PokemonController extends Controller
{
    /**
     * Stocke un nouveau Pokémon dans la base de données.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $this->validatePokemonData($request);

        if ($request->hasFile('image')) {
            $uuid = Str::uuid();
            $extension = $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs(
                'pokemons',
                $uuid . '.' . $extension,
                'public'
            );
        }

        $pokemon = Pokemon::create([
            'number' => $validatedData['number'],
            'name' => $validatedData['name'],
            'image' => $imagePath ?? null,
            'hp' => $validatedData['hp'],
            'attack' => $validatedData['attack'],
            'defense' => $validatedData['defense'],
            'speed' => $validatedData['speed'],
        ]);

        $types = Type::whereIn('name', $validatedData['types'])->get();
        $pokemon->types()->attach($types);

        return redirect()->route('pokemons.index')->with('success', 'Pokémon créé avec succès !');
    }

    /**
     * Met à jour un Pokémon dans la base de données.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $pokemonId)
    {
        $pokemon = Pokemon::findOrFail($pokemonId);
        $validatedData = $this->validatePokemonData($request);

        if ($request->hasFile('image')) {
            // Supprime l'ancienne image si elle existe
            if ($pokemon->image) {
                Storage::disk('public')->delete($pokemon->image);
            }

            // Enregistre la nouvelle image
            $uuid = Str::uuid();
            $extension = $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs(
                'pokemons',
                $uuid . '.' . $extension,
                'public'
            );
            $validatedData['image'] = $imagePath;
        }

        $pokemon->update([
            'number' => $validatedData['number'],
            'name' => $validatedData['name'],
            'image' => $validatedData['image'] ?? $pokemon->image,
            'hp' => $validatedData['hp'],
            'attack' => $validatedData['attack'],
            'defense' => $validatedData['defense'],
            'speed' => $validatedData['speed'],
        ]);

        $types = Type::whereIn('name', $validatedData['types'])->get();
        $pokemon->types()->sync($types);

        return redirect()->route('pokemons.show', $pokemon->id)->with('success', 'Pokémon mis à jour avec succès !');
    }

    /**
     * Supprime un Pokémon de la base de données.
     *
     * @param int $pokemonId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($pokemonId)
    {
        $pokemon = Pokemon::findOrFail($pokemonId);
        $pokemon->delete();
        return redirect()->route('pokemons.index')->with('success', 'Pokémon supprimé avec succès !');
    }

    private function validatePokemonData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|regex:/^[0-9]{4}$/',
            'types' => 'required|array|min:1',
            'types.*' => 'exists:types,name',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'hp' => 'required|integer|min:1',
            'attack' => 'required|integer|min:1',
            'defense' => 'required|integer|min:1',
            'speed' => 'required|integer|min:1'
        ], [
            'types.min' => 'Vous devez sélectionner au moins un type.',
            'types.*.exists' => 'Le type sélectionné n\'existe pas.',
            'number.regex' => 'Le numéro doit être composé de 4 chiffres.',
            'image.max' => 'L\'image doit être inférieure à 5MB.',
            'image.mimes' => 'L\'image doit être au format jpg, jpeg ou png.',
            'name.required' => 'Le nom est requis.',
            'number.required' => 'Le numéro est requis.',
            'types.required' => 'Vous devez sélectionner au moins un type.',
            'hp.required' => 'Les points de vie sont requis.',
            'attack.required' => 'L\'attaque est requise.',
            'defense.required' => 'La défense est requise.',
            'speed.required' => 'La vitesse est requise.',
            'hp.min' => 'Les points de vie doivent être supérieurs à 0.',
            'attack.min' => 'L\'attaque doit être supérieure à 0.',
            'defense.min' => 'La défense doit être supérieure à 0.',
            'speed.min' => 'La vitesse doit être supérieure à 0.',
        ]);
    }
}

