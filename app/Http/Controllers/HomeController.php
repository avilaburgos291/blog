<?php

namespace App\Http\Controllers;

use App\University;
use App\Course;
use App\Semester;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        //Tecnica de Eager Loanding para cargar la información de los usuarios con las entradas :)
    	//Llamamos el metodo creado en la realción del modelo university -> user :)
    	$universities = University::orderBy('id')
    	->orderBy('created_at')
        ->paginate(10);

        $courses = Course::orderBy('code')
        ->paginate(10);

        
        $courses_totales = DB::table('courses')
                ->join('semesters', 'courses.id', '=', 'semesters.course_id')
                ->select(
                    'courses.id as course_id',
                    'courses.*', DB::raw('SUM(semesters.price) as price_total_cuorse'),
                    DB::raw('AVG(semesters.price) as price_avg_cuorse')
                    )
                ->groupBy('courses.id')
                ->havingRaw('SUM(semesters.price) > ?', [0])
                ->paginate(10);

        $semesters = Semester::orderBy('code')
                ->paginate(10);


        //return view('welcome',  compact('universities'));
        return view('home', [
            'universities' => $universities,
            'courses' => $courses,
            'courses_totales' => $courses_totales,
            'semesters' => $semesters
        ]);

        //Se obtienen las entradas de cada usuario :)
        //$universities = University::where('user_id', auth()->id())->get();
        //return view('home', compact('universities'));
    }
}
