<?php

namespace App\Policies;

use App\User;
//Se carga la clase de la entrada :)
use App\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Course $course)
    {
        return $user->id === $course->user_id;
    }
}
