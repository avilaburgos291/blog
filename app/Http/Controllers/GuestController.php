<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;

class GuestController extends Controller
{
	public function index()
    {
    	//Tecnica de Eager Loanding para cargar la información de los usuarios con las entradas :)
    	//Llamamos el metodo creado en la realción del modelo Entry -> user :)
    	$entries = Entry::with('user')
    	->orderByDesc('created_at')
    	->orderByDesc('id')
    	->paginate(10);
    	return view('welcome',  compact('entries'));
    }

    public function show(Entry $entry)
    {
    	return view('entries.show',  compact('entry'));
    }
}
