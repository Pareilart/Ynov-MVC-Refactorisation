@extends('layouts.app')

@section('title', 'Modifier le Pokémon')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Modifier le Pokémon</h1>

        <form action="{{ route('pokemons.update', $pokemon->id) }}" method="POST"
            class="bg-white rounded-3xl px-8 pt-6 pb-8 mb-4 relative overflow-hidden" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Image de fond décorative -->
            <img src="{{ asset('assets/pokemon-icon.png') }}"
                class=" object-contain absolute -top-40 -right-60 opacity-5 max-w-3xl z-0">
            <!-- Contenu du formulaire avec z-index pour passer au-dessus de l'image -->
            <div class="relative z-10">
                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Nom
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                            id="name" type="text" name="name" value="{{ old('name', $pokemon->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="number">
                            Numéro
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('number') border-red-500 @enderror"
                            id="number" type="number" name="number" value="{{ old('number', $pokemon->number) }}"
                            required>
                        @error('number')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="block text-gray-700 text-sm font-bold mb-2">Sélectionnez le(s) type(s):</h3>
                    <ul class="grid w-full gap-6 md:grid-cols-4">
                        @foreach ($types as $type)
                            <li>
                                <input type="checkbox" id="type-{{ $type }}" name="types[]"
                                    value="{{ $type }}" class="hidden peer"
                                    {{ in_array($type, old('types', $pokemon->types->pluck('name')->toArray() ?? [])) ? 'checked' : '' }}>
                                <label for="type-{{ $type }}"
                                    class="inline-flex p-5 w-full border-2 rounded-lg cursor-pointer
                                      text-gray-500 bg-white border-gray-200 
                                      hover:text-gray-600 hover:bg-gray-50
                                      peer-checked:border-blue-600 peer-checked:text-gray-600">
                                    {{ $type }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    @error('types')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="hp">
                            Points de vie (HP)
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('hp') border-red-500 @enderror"
                            id="hp" type="number" name="hp" value="{{ old('hp', $pokemon->hp) }}" required>
                        @error('hp')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="attack">
                            Attaque
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('attack') border-red-500 @enderror"
                            id="attack" type="number" name="attack" value="{{ old('attack', $pokemon->attack) }}"
                            required>
                        @error('attack')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="defense">
                            Défense
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('defense') border-red-500 @enderror"
                            id="defense" type="number" name="defense" value="{{ old('defense', $pokemon->defense) }}"
                            required>
                        @error('defense')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="speed">
                            Vitesse
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('speed') border-red-500 @enderror"
                            id="speed" type="number" name="speed" value="{{ old('speed', $pokemon->speed) }}"
                            required>
                        @error('speed')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                        Image
                    </label>
                    @if ($pokemon->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $pokemon->image) }}"
                                alt="Image actuelle de {{ $pokemon->name }}" class="w-48 h-48 object-contain rounded-lg">
                        </div>
                    @endif
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror"
                        id="image" type="file" name="image" accept="image/*">
                    @error('image')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Modifier le Pokémon
                    </button>
                    <a href="{{ route('pokemons.index') }}" class="text-gray-600 hover:text-indigo-600">
                        Retour à la liste
                    </a>
                </div>
            </div>

        </form>
    </div>
@endsection
