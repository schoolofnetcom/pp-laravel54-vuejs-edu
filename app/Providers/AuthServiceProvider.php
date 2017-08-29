<?php

namespace SON\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use SON\Models\Admin;
use SON\Models\Student;
use SON\Models\Teacher;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'SON\Model' => 'SON\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::define('admin', function($user){
           return $user->userable instanceof Admin;
        });

        \Gate::define('teacher', function($user){
            return $user->userable instanceof Teacher;
        });

        \Gate::define('student', function($user){
            return $user->userable instanceof Student;
        });
    }
}
