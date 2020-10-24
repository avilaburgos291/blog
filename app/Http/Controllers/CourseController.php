<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        //Se obtienen las entradas de cada usuario :)
        $courses = Course::where('user_id', auth()->id())->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
    	return view('courses.create');
    }
    
    public function store(Request $request)
    {
    	$datos_validados = $request->validate([
            'code' => 'required|min:7|unique:courses',
    		'title' => 'required|min:7|max:255',
            'descripcion' => 'required|min:25|max:3000',            
            'university_id' => 'required'
    	]);

        $course = new Course();
        $course->code = $datos_validados['code'];
    	$course->title = $datos_validados['title'];
        $course->descripcion = $datos_validados['descripcion'];       
        $course->universuty_id = $datos_validados['university_id'];
    	$course->user_id = auth()->id();
    	$course->save();
    	$status = 'Your course has been created successfully.';
    	return back()->with(compact('status'));
    }

    public function edit(Coruse $course)
    {
        //Se adiciona validacion para la edición para un usuario diferente al usuario creador de la entrada :)
        /*if (auth->id() !== $course->user_id) {
            return redirect('/');
        }*/
        //Se adiciona validacion de permisos :)
        //Se hace uso de la funcionalidad de autorizacion :)
        $this->authorize('update', $course);
        return view('courses.edit',  compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        //Se adiciona validacion para la edición para un usuario diferente al usuario creador de la entrada :)
        /*if (auth->id() !== $course->user_id) {
            return redirect('/');
        }*/

        //Se adiciona validacion de permisos :)
        //Se hace uso de la funcionalidad de autorizacion :)
        $this->authorize('update', $course);

        //Se adiciona validacion pero exceptuando el registro actual :)
        //'title' => 'required|min:7|max:255|unique:courses,id,'.$course->id,

        $datos_validados = $request->validate([
            'code' => 'required|min:7|max:255|unique:courses,id,'.$course->id,
            'title' => 'required|min:7|max:255',
            'descripcion' => 'required|min:25|max:3000'
        ]);
        
        $course->code = $datos_validados['code'];
        $course->title = $datos_validados['title'];
        $course->descripcion = $datos_validados['descripcion'];
        $course->save();
        $status = 'Your course has been updated successfully.';
        return back()->with(compact('status'));
    }
}
