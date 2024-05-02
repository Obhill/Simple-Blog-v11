<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('edit-comment', function($user, $comment) {
            return $user->id === $comment->user_id;
        });

        Gate::define('delete-comment', function($user, $comment) {
            return $user->id === $comment->user_id || $user->hasRole('admin');
        });
    }
}
