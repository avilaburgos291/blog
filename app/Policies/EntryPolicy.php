<?php

namespace App\Policies;

use App\User;
//Se carga la clase de la entrada :)
use App\Entry;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntryPolicy
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

    public function update(User $user, Entry $entry)
    {
        return $user->id === $entry->user_id;
    }
}
