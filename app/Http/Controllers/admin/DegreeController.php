<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Exam;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    public function create($group_id)
    {
        $students = Group::with('students')->find($group_id)->students;
        $exams = Exam::get();
        if ($students->count() == 0) {
            return redirect()->back()->with(['error' => 'هذه المجموعة ليس بها طلاب']);
        }
        return view('admin.degrees.create', compact('students', 'exams'));
    }

    public function store(Request $request)
    {
        $max_degree = Exam::find($request->exam_id);
        if ($request->degree > $max_degree->max_degree) {
            return redirect()->back()->with(['error' => 'يجب ان تكون الدرجة اصغر من الدرجة الكلية ']);
        }
        $arr = [];
        $degrees = Degree::where('student_id', $request->student_id)->get();
        for ($i = 0; $i < $degrees->count(); $i++) {
            $arr[] = $degrees[$i]['exam_id'];
        }
        if (!in_array($request->exam_id, $arr)) {
            Degree::create($request->except('_token'));
            return redirect()->back()->with(['success' => 'تم تسجيل الدرجة']);
        } else
            return redirect()->back()->with(['error' => ' تم التسجيل من قبل']);
    }

    public function show($group_id)
    {
        // return  $exams = Exam::find(5)->degrees;
        $exams = Exam::get();
        return view('admin.degrees.index', compact('group_id', 'exams'));
    }

    public function results($group_id, $exam_id)
    {
        $degrees = Degree::where('group_id', $group_id)->where('exam_id', $exam_id)->get();
        return view('admin.degrees.results', compact('degrees', 'group_id', 'exam_id'));
    }
}
