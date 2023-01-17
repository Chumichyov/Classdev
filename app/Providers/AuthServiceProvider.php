<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\About;
use App\Models\Course;
use App\Models\User;
use App\Policies\Admin\IndexPolicy;
use App\Policies\Course\LeaderPolicy;
use App\Policies\Profile\PhotoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => IndexPolicy::class,
        Course::class => LeaderPolicy::class,
        About::class => PhotoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
