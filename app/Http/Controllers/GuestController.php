<?php

namespace App\Http\Controllers;

use App\University;
use App\Course;
use App\Semester;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GuestController extends Controller
{
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
        return view('welcome', [
            'universities' => $universities,
            'courses' => $courses,
            'courses_totales' => $courses_totales,
            'semesters' => $semesters
        ]);
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
