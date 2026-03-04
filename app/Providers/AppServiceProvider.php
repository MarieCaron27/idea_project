<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard(); //Désactive la protection contre le mass assignment (remplit automatiquement tous les champs)
        Model::shouldBeStrict(); //Active le mode strict (erreurs si attribut inconnu, lazy loading interdit, etc.)
        Model::automaticallyEagerLoadRelationships(); //Active le chargement automatique des relations pour éviter les problèmes N+1
    }
}
