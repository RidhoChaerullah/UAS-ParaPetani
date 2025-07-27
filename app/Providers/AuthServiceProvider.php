<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Plant; // <-- Tambahkan ini
use App\Policies\PlantPolicy; // <-- Tambahkan ini
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Plant::class => PlantPolicy::class, // <-- Tambahkan baris ini
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}