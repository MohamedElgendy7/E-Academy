<?php

namespace App\Http\Controllers;

use App\Models\Doc;
use App\Models\Grade;
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
        return view('front.index');
    }


    public function profile(Request $request)
    {
        $student = Student::with('absent', 'degree')->find($request->id);
        $absent = $student->absent;
        $degrees = $student->degree;
        $cashs = $student->cash;
        return view('front.profile', compact('student', 'absent', 'degrees', 'cashs'));
    }

    public function video($student_id)
    {
        $videos = Video::student($student_id)->active()->get();
        return view('front.videos', compact('videos'));
    }
    public function Doc($grade_id, $student_id)
    {
        $docs = Doc::student($student_id)->where('grade_id', $grade_id)->get();
        return view('front.Docs', compact('docs'));
    }

    public function gradeDetect($student_id)
    {
        $grades = Grade::student($student_id)->get();
        return view('front.grades', compact('grades', 'student_id'));
    }
}
