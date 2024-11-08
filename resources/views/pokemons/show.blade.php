@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="{{ $pokemon->backgroundColor }} rounded-3xl shadow-lg overflow-hidden relative">
        <img src="{{ asset('assets/pokemon-icon.png') }}" 
             class=" object-contain absolute -top-40 -right-60 opacity-5 max-w-3xl z-0">
             
        <div class="md:flex relative z-10">
            <div class="md:w-1/3 p-6">
                @if($pokemon->image)
                    <img src="{{ asset('storage/' . $pokemon->image) }}" 
                         alt="{{ $pokemon->name }}" 
                         class="w-full h-64 object-contain">
                @else
                    <div class="w-full h-64 flex items-center justify-center">
                        <i class="fas fa-image text-white text-6xl"></i>
                    </div>
                @endif
            </div>
            
            <div class="md:w-2/3 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-4xl font-bold text-white">{{ $pokemon->name }}</h1>
                    <a href="{{ route('pokemons.edit', $pokemon) }}" 
                       class="inline-flex items-center px-4 py-2 bg-white bg-opacity-30 text-white font-medium rounded-full hover:bg-opacity-40 transition duration-150 ease-in-out">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier
                    </a>
                </div>
                
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div>
                        <p class="text-white text-opacity-80 mb-2">Type</p>
                        <div class="flex gap-2">
                            @foreach($pokemon->types as $type)
                                <span class="px-4 py-1 rounded-full text-sm font-medium bg-white bg-opacity-30 text-white">
                                    {{ $type->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    
                    <div>
                        <p class="text-white text-opacity-80 mb-2">Numéro</p>
                        <p class="text-white font-semibold text-xl">#{{ str_pad($pokemon->number, 3, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <h2 class="text-2xl font-semibold text-white mb-4">Statistiques</h2>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-white text-opacity-80 mb-2">PV</p>
                                <div class="w-full bg-white bg-opacity-30 rounded-full h-3">
                                    <div class="bg-white h-3 rounded-full" style="width: {{ ($pokemon->hp / 255) * 100 }}%"></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-white text-opacity-80 mb-2">Attaque</p>
                                <div class="w-full bg-white bg-opacity-30 rounded-full h-3">
                                    <div class="bg-white h-3 rounded-full" style="width: {{ ($pokemon->attack / 255) * 100 }}%"></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-white text-opacity-80 mb-2">Défense</p>
                                <div class="w-full bg-white bg-opacity-30 rounded-full h-3">
                                    <div class="bg-white h-3 rounded-full" style="width: {{ ($pokemon->defense / 255) * 100 }}%"></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-white text-opacity-80 mb-2">Vitesse</p>
                                <div class="w-full bg-white bg-opacity-30 rounded-full h-3">
                                    <div class="bg-white h-3 rounded-full" style="width: {{ ($pokemon->speed / 255) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
