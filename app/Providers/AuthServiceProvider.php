<?php

namespace App\Providers;

use App\Models\Animal;
use App\Policies\AnimalPolicy;
use App\Policies\EventPolicy;
use App\Models\Event;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Donation;
use App\Policies\DonationPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * El mapa de políticas para la aplicación.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Animal::class => AnimalPolicy::class,
        Event::class => EventPolicy::class,
        Donation::class => DonationPolicy::class,
    ];

    /**
     * Registra cualquier servicio de autenticación / autorización.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Registrar las políticas de acceso a eventos y animales de manera explícita
        Gate::define('view-any-animal', [AnimalPolicy::class, 'viewAny']);
        Gate::define('view-animal', [AnimalPolicy::class, 'view']);
        Gate::define('update-animal', [AnimalPolicy::class, 'update']);
        Gate::define('delete-animal', [AnimalPolicy::class, 'delete']);
        
        Gate::define('view-any-event', [EventPolicy::class, 'viewAny']);
        Gate::define('view-event', [EventPolicy::class, 'view']);
        Gate::define('update-event', [EventPolicy::class, 'update']);
        Gate::define('delete-event', [EventPolicy::class, 'delete']);

        Gate::define('create-donation', [DonationPolicy::class, 'create']);
        Gate::define('update-donation', [DonationPolicy::class, 'update']);
        Gate::define('delete-donation', [DonationPolicy::class, 'delete']);
    }
}
