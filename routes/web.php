<?php

use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\PokemonController;
use App\Http\Controllers\PokemonShowController;

 // Route principale pour afficher la liste des Pokémons
 Route::get('/', [PokemonShowController::class, 'index'])->name('pokemons.index');

Route::prefix('pokemons')->group(function () {
    // Routes GET
    Route::get('/create', [PokemonShowController::class, 'create'])->name('pokemons.create');
    Route::get('/{pokemonId}', [PokemonShowController::class, 'show'])->name('pokemons.show');
    Route::get('/{pokemonId}/edit', [PokemonShowController::class, 'edit'])->name('pokemons.edit');

    // Routes POST, PUT, DELETE
    Route::post('/', [PokemonController::class, 'store'])->name('pokemons.store');
    Route::put('/{pokemonId}', [PokemonController::class, 'update'])->name('pokemons.update');
    Route::delete('/{pokemonId}', [PokemonController::class, 'destroy'])->name('pokemons.destroy');
});
