<?php

namespace App\Http\Controllers;

use App\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        //Se obtienen las entradas de cada usuario :)
        $semesters = Semester::where('user_id', auth()->id())->get();
        return view('semesters.index', compact('semesters'));
    }

    public function create()
    {
    	return view('semesters.create');
    }
    
    public function store(Request $request)
    {
    	$datos_validados = $request->validate([
            'code' => 'required|min:7|unique:semesters',
    		'title' => 'required|min:7|max:255',
            'descripcion' => 'required|min:25|max:3000',            
            'course_id' => 'required'
    	]);

        $semester = new Semester();
        $semester->code = $datos_validados['code'];
    	$semester->title = $datos_validados['title'];
        $semester->descripcion = $datos_validados['descripcion'];       
        $semester->coruse_id = $datos_validados['course_id'];
    	$semester->user_id = auth()->id();
    	$semester->save();
    	$status = 'Your semester has been created successfully.';
    	return back()->with(compact('status'));
    }

    public function edit(Semester $semester)
    {
        //Se adiciona validacion para la edición para un usuario diferente al usuario creador de la entrada :)
        /*if (auth->id() !== $semester->user_id) {
            return redirect('/');
        }*/
        //Se adiciona validacion de permisos :)
        //Se hace uso de la funcionalidad de autorizacion :)
        $this->authorize('update', $semester);
        return view('semesters.edit',  compact('course'));
    }

    public function update(Request $request, Semester $semester)
    {
        //Se adiciona validacion para la edición para un usuario diferente al usuario creador de la entrada :)
        /*if (auth->id() !== $semester->user_id) {
            return redirect('/');
        }*/

        //Se adiciona validacion de permisos :)
        //Se hace uso de la funcionalidad de autorizacion :)
        $this->authorize('update', $semester);

        //Se adiciona validacion pero exceptuando el registro actual :)
        //'title' => 'required|min:7|max:255|unique:semesters,id,'.$semester->id,

        $datos_validados = $request->validate([
            'code' => 'required|min:7|max:255|unique:semesters,id,'.$semester->id,
            'title' => 'required|min:7|max:255',
            'descripcion' => 'required|min:25|max:3000'
        ]);
        
        $semester->code = $datos_validados['code'];
        $semester->title = $datos_validados['title'];
        $semester->descripcion = $datos_validados['descripcion'];
        $semester->save();
        $status = 'Your semester has been updated successfully.';
        return back()->with(compact('status'));
    }
}
