<?php

namespace App\Http\Controllers;

use App\User;
use App\Entry;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function show(User $user)
    {
    	//Se obtienen las entradas del usuario :)
    	$entries = Entry::where('user_id', $user->id)->get();
    	//Tambien se pueden obtener las entradas del usuario haciendo uso de la relación :)
    	//$user->entries;
    	//Se envian la información del usuario :)
    	//Se adicionan las entradas asociadas al usuario :)
    	return view('users.show',  compact('user', 'entries'));
    }
}
