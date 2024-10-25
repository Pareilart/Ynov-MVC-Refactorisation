<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémons</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @csrf
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Liste des Pokémons</h1>

        @if ($pokemons->isEmpty())
            <p class="text-center text-gray-500">0 résultats</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($pokemons as $pokemon)
                    <div class="bg-white shadow-md rounded-lg p-4 border border-gray-200">
                        <h2 class="text-2xl font-semibold text-blue-500">{{ $pokemon->name }}</h2>
                        <p class="text-gray-700">{{ $pokemon->type }}</p>

                        <form action="{{ route('pokemons.destroy', $pokemon->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                Supprimer
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

</body>

</html>

