<?php

namespace App\Enums;

enum EnumPokemonType: string
{
    case FEU = 'Feu';
    case EAU = 'Eau';
    case PLANTE = 'Plante';
    case ELECTRIK = 'Électrik';
    case PSY = 'Psy';
    case COMBAT = 'Combat';
    case VOL = 'Vol';
    case POISON = 'Poison';
    case SOL = 'Sol';
    case ROCHE = 'Roche';
    case INSECTE = 'Insecte';
    case SPECTRE = 'Spectre';
    case DRAGON = 'Dragon';
    case ACIER = 'Acier';
    case TENEBRES = 'Ténèbres';
    case FEE = 'Fée';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getBackgroundColor(): string
    {
        return match($this) {
            self::FEU => 'bg-red-400',
            self::EAU => 'bg-blue-400',
            self::PLANTE => 'bg-emerald-400',
            self::ELECTRIK => 'bg-yellow-400',
            self::PSY => 'bg-pink-400',
            self::COMBAT => 'bg-orange-400',
            self::VOL => 'bg-sky-400',
            self::POISON => 'bg-purple-400',
            self::SOL => 'bg-amber-400',
            self::ROCHE => 'bg-stone-400',
            self::INSECTE => 'bg-lime-400',
            self::SPECTRE => 'bg-indigo-400',
            self::DRAGON => 'bg-violet-400',
            self::ACIER => 'bg-slate-400',
            self::TENEBRES => 'bg-gray-700',
            self::FEE => 'bg-rose-400',
        };
    }
} 