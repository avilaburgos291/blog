<?php

namespace App\Providers;

//Se carga la clase de la entrada :)
use App\Entry;
//Se carga la clase de la pilitica de la entrada :)
use App\Policies\EntryPolicy;
//Se carga la clase de la entrada :)
use App\University;
//Se carga la clase de la pilitica de la entrada :)
use App\Policies\UniversityPolicy;

//Se carga la clase de la entrada :)
use App\Course;
//Se carga la clase de la pilitica de la entrada :)
use App\Policies\CoursePolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        //Las politicas deben estar asociadas a un modelo :)
        University::class => UniversityPolicy::class,
        Course::class => CoursePolicy::class
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
