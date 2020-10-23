<?php

namespace App\Http\Controllers;

use App\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {
    	return view('universities.create');
    }

    public function store(Request $request)
    {
    	$datos_validados = $request->validate([
    		'title' => 'required|min:7|max:255',
    		'description' => 'required|min:25|max:3000'
    	]);

    	$university = new University();
    	$university->title = $datos_validados['title'];
    	$university->description = $datos_validados['description'];
    	$university->user_id = auth()->id();
    	$university->save();
    	$status = 'Your university has been created successfully.';
    	return back()->with(compact('status'));
    }

    public function edit(University $university)
    {
        //Se adiciona validacion para la edición para un usuario diferente al usuario creador de la entrada :)
        /*if (auth->id() !== $university->user_id) {
            return redirect('/');
        }*/
        //Se adiciona validacion de permisos :)
        //Se hace uso de la funcionalidad de autorizacion :)
        $this->authorize('update', $university);
        return view('universities.edit',  compact('university'));
    }

    public function update(Request $request, University $university)
    {
        //Se adiciona validacion para la edición para un usuario diferente al usuario creador de la entrada :)
        /*if (auth->id() !== $university->user_id) {
            return redirect('/');
        }*/

        //Se adiciona validacion de permisos :)
        //Se hace uso de la funcionalidad de autorizacion :)
        $this->authorize('update', $university);

        //Se adiciona validacion pero exceptuando el registro actual :)
        //'name' => 'required|min:7|max:255|unique:universities,id,'.$university->id,

        $datos_validados = $request->validate([
            'title' => 'required|min:7|max:255|unique:universities,id,'.$university->id,
            'description' => 'required|min:25|max:3000'
        ]);

        $university->title = $datos_validados['title'];
        $university->description = $datos_validados['description'];
        $university->save();
        $status = 'Your university has been updated successfully.';
        return back()->with(compact('status'));
    }
}
