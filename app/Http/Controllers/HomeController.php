<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function profile(Request $request)
    {
        $student = Student::with('absent', 'degree')->find($request->id);
        $absent = $student->absent;
        $degrees = $student->degree;
        $cashs = $student->cash;
        return view('front.profile', compact('student', 'absent', 'degrees', 'cashs'));
    }


    // public function test()
    // {
    //     return  path();
    // }
}
