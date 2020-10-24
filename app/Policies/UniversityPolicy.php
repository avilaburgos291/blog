<?php

namespace App\Policies;

use App\User;
//Se carga la clase de la entrada :)
use App\University;
use Illuminate\Auth\Access\HandlesAuthorization;

class UniversityPolicy
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

    public function update(User $user, University $university)
    {
        return $user->id === $university->user_id;
    }
}
