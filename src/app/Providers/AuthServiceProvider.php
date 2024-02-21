<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        // 管理者ユーザー
        Gate::define('admin', function (User $user) {
            return ($user->role_id === 10);
        });

        // 店舗代表者ユーザー
        Gate::define('representative', function (User $user) {
            return ($user->role_id === 5);
        });

        // 一般ユーザー
        Gate::define('general', function (User $user) {
            return ($user->role_id === 1);
        });
    }
}
