<?php

namespace App\Http\Controllers;

use App\Semester;
use App\Course;
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
        //$semesters = Semester::where('user_id', auth()->id())->get();
        $semesters = Semester::orderByDesc('created_at')
    	->orderByDesc('id')
    	->paginate(10);
        return view('semesters.index', compact('semesters'));
    }

    public function show(Semester $semesterBySlug)
    {
        //Se modifica metodo de envio por un array asociativo :)
        return view('semesters.show',  [
            'semester' => $semesterBySlug
        ]);

    }

    public function create()
    {
        //Se obtienen las entradas del usuario :)
        $courses = Course::select('id', 'title')->get(); 
        return view('semesters.create',  compact('courses'));
    	//return view('semesters.create');
    }
    
    public function store(Request $request)
    {
    	$datos_validados = $request->validate([
            'code' => 'required|min:4|max:255|unique:semesters',
    		'title' => 'required|min:7|max:255|unique:semesters',
            'description' => 'required|min:25|max:3000',            
            'course_id' => 'required'
    	]);

        $semester = new Semester();
        $semester->code = $datos_validados['code'];
    	$semester->title = $datos_validados['title'];
        $semester->description = $datos_validados['description'];
        $min = 1000000; //1.000.000 y 10.000.000
        $max = 10000000;        
        $semester->price = mt_rand ($min*10, $max*10) / 10;     
        $semester->course_id = $datos_validados['course_id'];
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
        $courses = Course::select('id', 'title')->get();
        $this->authorize('update', $semester);
        return view('semesters.edit',  compact('semester', 'courses'));
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
            'code' => 'required|min:4|max:255|unique:semesters,id,'.$semester->id,
    		'title' => 'required|min:7|max:255|unique:semesters,id,'.$semester->id,
            'description' => 'required|min:25|max:3000',            
            'course_id' => 'required'
        ]);
        
        $semester->code = $datos_validados['code'];
        $semester->title = $datos_validados['title'];
        $semester->description = $datos_validados['description'];
        $semester->course_id = $datos_validados['course_id'];
        $semester->save();
        $status = 'Your semester has been updated successfully.';
        return back()->with(compact('status'));
    }
}
