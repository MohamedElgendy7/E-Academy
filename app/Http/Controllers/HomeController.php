<?php

namespace App\Http\Controllers;

use App\Models\Doc;
use App\Models\Student;
use App\Models\Video;
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

    public function UserIndex()
    {
        $videos = Video::active()->get();
        return view('front.UserIndex', compact('videos'));
    }
    public function Doc($grade_id)
    {
        $docs = Doc::where('grade_id', $grade_id)->get();
        return view('front.Docs', compact('docs'));
    }
}
