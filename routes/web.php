<?php

use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\PokemonController;

// Route principale pour afficher la liste des Pokémons
Route::get('/', [PokemonController::class, 'index'])->name('pokemons.index');

// Route pour afficher le formulaire de création d'un Pokémon
Route::get('/pokemons/create', [PokemonController::class, 'create'])->name('pokemons.create');

// Route pour stocker un nouveau Pokémon
Route::post('/pokemons', [PokemonController::class, 'store'])->name('pokemons.store');

// Route pour afficher un Pokémon spécifique (pour la mise à jour, par exemple)
Route::get('/pokemons/{pokemon}', [PokemonController::class, 'show'])->name('pokemons.show');

// Route pour afficher le formulaire d'édition d'un Pokémon
Route::get('/pokemons/{pokemon}/edit', [PokemonController::class, 'edit'])->name('pokemons.edit');

// Route pour mettre à jour un Pokémon
Route::put('/pokemons/{pokemon}', [PokemonController::class, 'update'])->name('pokemons.update');

// Route pour supprimer un Pokémon
Route::delete('/pokemons/{pokemon}', [PokemonController::class, 'destroy'])->name('pokemons.destroy');

