<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {
    	return view('entries.create');
    }

    public function store(Request $request)
    {
    	$datos_validados = $request->validate([
    		'title' => 'required|min:7|max:255|unique:entries',
    		'content' => 'required|min:25|max:3000'
    	]);

    	$entry = new Entry();
    	$entry->title = $datos_validados['title'];
    	$entry->content = $datos_validados['content'];
    	$entry->user_id = auth()->id();
    	$entry->save();
    	$status = 'Your entry has been published successfully.';
    	return back()->with(compact('status'));
    }

    public function edit(Entry $entry)
    {
        //Se adiciona validacion para la edición para un usuario diferente al usuario creador de la entrada :)
        /*if (auth->id() !== $entry->user_id) {
            return redirect('/');
        }*/
        //Se adiciona validacion de permisos :)
        //Se hace uso de la funcionalidad de autorizacion :)
        $this->authorize('update', $entry);
        return view('entries.edit',  compact('entry'));
    }

    public function update(Request $request, Entry $entry)
    {
        //Se adiciona validacion para la edición para un usuario diferente al usuario creador de la entrada :)
        /*if (auth->id() !== $entry->user_id) {
            return redirect('/');
        }*/

        //Se adiciona validacion de permisos :)
        //Se hace uso de la funcionalidad de autorizacion :)
        $this->authorize('update', $entry);

        //Se adiciona validacion pero exceptuando el registro actual :)
        //'title' => 'required|min:7|max:255|unique:entries,id,'.$entry->id,

        $datos_validados = $request->validate([
            'title' => 'required|min:7|max:255|unique:entries,id,'.$entry->id,
            'content' => 'required|min:25|max:3000'
        ]);

        $entry->title = $datos_validados['title'];
        $entry->content = $datos_validados['content'];
        $entry->save();
        $status = 'Your entry has been updated successfully.';
        return back()->with(compact('status'));
    }
}
