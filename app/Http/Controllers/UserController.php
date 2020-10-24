<?php

namespace App\Http\Controllers;

use App\User;
use App\University;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function show(User $user)
    {
    	//Se obtienen las entradas del usuario :)
    	$universities = University::where('user_id', $user->id)->get();
    	//Tambien se pueden obtener las entradas del usuario haciendo uso de la relación :)
    	//$user->universities;
    	//Se envian la información del usuario :)
    	//Se adicionan las entradas asociadas al usuario :)
    	return view('users.show',  compact('user', 'universities'));
    }
}
