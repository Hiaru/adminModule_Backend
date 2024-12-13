<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * USE CUSTOM PERSONAL ACCESS TOKEN
 */
use Laravel\Sanctum\Sanctum;
use App\Models\Config\customPersonalAccessToken;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * USE PERSONAL ACCESS TOKEN TO AUTHENTICATE USERS
         */
        Sanctum::usePersonalAccessTokenModel(customPersonalAccessToken::class);
    }
}
