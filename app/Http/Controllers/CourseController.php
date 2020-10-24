<?php

namespace App\Http\Controllers;

use App\Course;
use App\University;
use App\Semester;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CourseController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        $courses_totales = DB::table('courses')
                ->join('semesters', 'courses.id', '=', 'semesters.course_id')
                ->select('courses.id as course_id','courses.*', DB::raw('SUM(semesters.price) as price_total_cuorse'))
                ->groupBy('courses.id')
                ->havingRaw('SUM(semesters.price) > ?', [0])
                ->paginate(10);
        //Se obtienen las entradas de cada usuario :)
        $courses = Course::orderBy('code')
        ->paginate(10);

        $semesters = Semester::orderBy('code')
        ->paginate(10);
        

        return view('courses.index', [
            'courses' => $courses,
            'courses_totales' => $courses_totales,
            'semesters' => $semesters
        ]);
        //return view('courses.index', compact('courses'));
    }

    public function show(Course $courseBySlug)
    {
        //Se modifica metodo de envio por un array asociativo :)
        return view('courses.show',  [
            'course' => $courseBySlug
        ]);

    }

    public function create()
    {        
        //Se obtienen las entradas del usuario :)
        $universities = University::select('id', 'title')->get(); 
        return view('courses.create',  compact('universities'));
    	//return view('courses.create');
    }
    
    public function store(Request $request)
    {
    	$datos_validados = $request->validate([
            'code' => 'required|min:4|max:255|unique:courses',
    		'title' => 'required|min:7|max:255|unique:courses',
            'description' => 'required|min:25|max:3000',            
            'university' => 'required'
    	]);

        $course = new Course();
        $course->code = $datos_validados['code'];
    	$course->title = $datos_validados['title'];
        $course->description = $datos_validados['description'];       
        $course->university_id = $datos_validados['university'];
    	$course->user_id = auth()->id();
    	$course->save();
    	$status = 'Your course has been created successfully.';
    	return back()->with(compact('status'));
    }

    public function edit(Course $course)
    {
        //Se adiciona validacion para la edición para un usuario diferente al usuario creador de la entrada :)
        /*if (auth->id() !== $course->user_id) {
            return redirect('/');
        }*/
        //Se adiciona validacion de permisos :)
        //Se hace uso de la funcionalidad de autorizacion :)
        $universities = University::select('id', 'title')->get(); 
        $this->authorize('update', $course);
        return view('courses.edit',  compact('course', 'universities'));
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
            'code' => 'required|min:4|max:255|unique:courses,id,'.$course->id,
    		'title' => 'required|min:7|max:255|unique:courses,id,'.$course->id,
            'description' => 'required|min:25|max:3000',            
            'university' => 'required'
        ]);
        
        $course->code = $datos_validados['code'];
    	$course->title = $datos_validados['title'];
        $course->description = $datos_validados['description'];       
        $course->university_id = $datos_validados['university'];

        $course->save();
        $status = 'Your course has been updated successfully.';
        return back()->with(compact('status'));
    }
}
