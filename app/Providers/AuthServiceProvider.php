<?php

namespace App\Providers;

//Se carga la clase de la entrada :)
use App\Entry;
use App\Policies\EntryPolicy;
//Se carga la clase de la entrada :)
use App\University;
use App\Policies\UniversityPolicy;
//Se carga la clase de la entrada :)
use App\Course;
use App\Policies\CoursePolicy;

use App\Semester;
use App\Policies\SemesterPolicy;

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
        Course::class => CoursePolicy::class,
        Semester::class => SemesterPolicy::class
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
