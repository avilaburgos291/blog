<?php

namespace App\Policies;

use App\User;
//Se carga la clase de la entrada :)
use App\Semester;
use Illuminate\Auth\Access\HandlesAuthorization;

class SemesterPolicy
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

    public function update(User $user, Semester $semester)
    {
        return $user->id === $semester->user_id;
    }
}
