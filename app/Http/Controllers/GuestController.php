<?php

namespace App\Http\Controllers;

use App\University;
use Illuminate\Http\Request;

class GuestController extends Controller
{
	public function index()
    {
    	//Tecnica de Eager Loanding para cargar la información de los usuarios con las entradas :)
    	//Llamamos el metodo creado en la realción del modelo university -> user :)
    	$universities = University::orderByDesc('created_at')
    	->orderByDesc('id')
    	->paginate(10);
    	return view('welcome',  compact('universities'));
    }

    public function show(University $universityBySlug)
    {
        //Se modifica metodo de envio por un array asociativo :)
    	//return view('universities.show',  compact('university'));
        return view('universities.show',  [
            'university' => $universityBySlug
        ]);

    }
}
