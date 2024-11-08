@extends('layouts.app')

@section('title', 'Liste des Pokémons')

@section('content')
    <header class="mb-12 text-center">
        <h1 class="text-5xl font-bold text-indigo-600 mb-4">Liste des Pokémons</h1>
        <a href="{{ route('pokemons.create') }}"
            class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-full hover:bg-indigo-700 transition-colors">
            <i class="fas fa-plus mr-2"></i>Ajouter un Pokémon
        </a>
    </header>

    @if ($pokemons->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-search text-gray-400 text-5xl mb-4"></i>
            <p class="text-xl text-gray-500">Aucun Pokémon trouvé</p>
        </div>
    @else
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($pokemons as $pokemon)
                    <div class="{{ $pokemon->backgroundColor }} rounded-3xl shadow-lg overflow-hidden relative">
                        <img src="{{ asset('assets/pokemon-icon.png') }}" 
                            class="w-full h-full object-contain absolute -top-20 -right-40 opacity-5 z-0">
                        <div class="p-6 z-10 relative">
                            <div class="flex items-center">
                                <div class="w-full">
                                    <div class="flex justify-between items-center">
                                        <a href="{{ route('pokemons.show', $pokemon->id) }}"
                                            class="text-2xl font-bold text-white hover:text-gray-100 transition-colors">
                                            {{ $pokemon->name }}
                                        </a>
                                    </div>
                                    
                                    <div class="mt-3">
                                        <div class="flex gap-2">
                                            @foreach($pokemon->types as $type)
                                                <span class="px-4 py-1 rounded-full text-sm font-medium bg-white bg-opacity-30 text-white">
                                                    {{ $type->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center mt-6">
                                        <a href="{{ route('pokemons.edit', $pokemon->id) }}"
                                            class="text-white hover:text-gray-200 transition-colors">
                                            <i class="fas fa-edit mr-1"></i>Éditer
                                        </a>

                                        <button type="button" onclick="openDeleteModal({{ $pokemon->id }}, '{{ $pokemon->name }}')"
                                            class="text-white hover:text-gray-200 transition-colors">
                                            <i class="fas fa-trash-alt mr-1"></i>Supprimer
                                        </button>
                                    </div>
                                </div>
                                <div class="w-48 h-48 top-0 left-0">
                                    @if ($pokemon->image)
                                        <img src="{{ asset('storage/' . $pokemon->image) }}" 
                                            alt="{{ $pokemon->name }}"
                                            class="w-full h-full object-contain">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-image text-white text-6xl"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection

<!-- Modal de suppression -->
<div id="deleteModal"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 backdrop-blur-sm">
    <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
        <h2 class="text-2xl font-bold mb-4">Confirmer la suppression</h2>
        <p class="mb-6">Êtes-vous sûr de vouloir supprimer le Pokémon <span id="pokemonName"
                class="font-semibold"></span> ?</p>

        <form id="deleteForm" method="POST" class="flex justify-end gap-4">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeDeleteModal()"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                Annuler
            </button>
            <button type="submit"
                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                Supprimer
            </button>
        </form>
    </div>
</div>

<script>
    function openDeleteModal(pokemonId, pokemonName) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const nameSpan = document.getElementById('pokemonName');

        form.action = `/pokemons/${pokemonId}`;
        nameSpan.textContent = pokemonName;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
