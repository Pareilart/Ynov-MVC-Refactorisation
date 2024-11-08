# Projet Pokémon Laravel

Bienvenue dans le projet Pokémon, une application simple utilisant Laravel pour gérer une liste de Pokémon. Ce porjet met en application le modèle MVC.

## Prérequis
- PHP >= 8.1
- Composer

## Installation

1. Cloner le projet
```bash
gh repo clone Pareilart/Ynov-Refactorisation
gh repo clone Pareilart/Ynov-Refactorisation
```

2. Installer les dépendances
```bash
composer install
```

3. Configuration initiale
```bash
cp .env.example .env
php artisan key:generate
```

4. Configurer la base de données
Modifier le fichier `.env` avec vos informations de base de données :
```
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

5. Initialiser la base de données
```bash
php artisan migrate:fresh
php artisan db:seed
```

## Lancement du projet

1. Démarrer le serveur Laravel
```bash
php artisan serve
```

L'application sera accessible à l'adresse : http://127.0.0.1:8000

## Structure du projet

- `app/Models/Pokemon.php` - Modèle Pokemon
- `app/Http/Controllers/PokemonController.php` - Controller Pokemon
- `resources/views/pokemons/index.blade.php` - Vue pour afficher la liste des Pokémons
- `database/migrations` - Migrations de la base de données
- `database/seeders/PokemonSeeder.php` - Seeder pour peupler la base de données

## Commandes utiles

- Recréer la base de données et la peupler :
```bash
php artisan migrate:fresh --seed
```

- Lancer uniquement le seeder Pokemon :
```bash
php artisan db:seed --class=PokemonSeeder
```

- Vider le cache :
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Problèmes courants

Si vous rencontrez des erreurs :

1. Vérifiez que toutes les dépendances sont installées
```bash
composer install
npm install
```

2. Vérifiez que la base de données est bien configurée dans le .env

3. Régénérez la clé d'application si nécessaire
```bash
php artisan key:generate
```
