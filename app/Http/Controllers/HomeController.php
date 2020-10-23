<?php

namespace App\Http\Controllers;

use App\University;
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
        //Se obtienen las entradas de cada usuario :)
        $universities = University::where('user_id', auth()->id())->get();
        return view('home', compact('universities'));
    }
}
