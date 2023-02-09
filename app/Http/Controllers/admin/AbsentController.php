<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Absent;
use App\Models\Group;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;


class AbsentController extends Controller
{
    public function create($id)
    {
        $students = Group::find($id)->students;
        $count = $students->count();
        $today = Carbon::today();
        $truncated = Str::limit($today, 10, '');
        if ($students->count() == 0) {
            return redirect()->back()->with(['error' => 'هذه المجموعة ليس بها طلاب']);
        }
        return view('admin.absent.create', compact('students', 'count', 'truncated'));  //
    }

    public function store(Request $request)
    {
        // return $request;
        if (!$request->has('status')) {
            $request->request->add(['status' => 0]);
        }
        $student = Student::find($request->student_id);
        $absent = $student->absent;
        $arr = [];
        for ($i = 0; $i < $absent->count(); $i++) {
            $arr[] = $absent[$i]['day'];
        }
        if (!in_array(strval($request->day), $arr)) {
            Absent::create($request->except(['_token']));
            return redirect()->back()->with(['success' => 'تم تسجيل الحضور'],);
        } else
            return redirect()->back()->with(['error' => 'مسجل من قبل']);
    }

    public function QRstore($id)
    {
        $student = Student::with('absent')->find($id);
        $absent = $student->absent;
        $today = Carbon::today();
        $truncated = Str::limit($today, 10, '');
        $arr = [];
        for ($i = 0; $i < $absent->count(); $i++) {
            $arr[] = $absent[$i]['day'];
        }
        if (!in_array(strval($truncated), $arr)) {
            Absent::create([
                'day' => $truncated,
                'student_id' => $id,
                'status' => 1,
                'group_id' => $student->group_id,
            ]);
            return '<center>تم تسجيل الحضور</center>';
        } else
            return redirect()->back()->with(['error' => 'مسجل من قبل']);
    }

    public function download($id)
    {
        $filepath = public_path('qrcodes\\') . $id . ".png";
        return Response::download($filepath);
    }


    public function absentStudent($id)
    {
        $today = Carbon::today();
        $truncated = Str::limit($today, 10, '');

        $arr = [];
        $students = Student::where('group_id', $id)->get();
        $unAbsentStudent =  Absent::select('student_id')->absent($id, $truncated, 1)->get();
        for ($i = 0; $i < $unAbsentStudent->count(); $i++) {
            $arr[] = $unAbsentStudent[$i]['student_id'];
        }
        foreach ($students as $student) {
            if (!in_array($student->id, $arr)) {
                $check = Absent::where('student_id', $student->id)->where('day', $truncated)->get();
                if ($check->count() == 0) {
                    Absent::create([
                        'day' => $truncated,
                        'student_id' => $student->id,
                        'group_id' => $student->group_id,
                        'status' => 0,
                    ]);
                }
            }
        }
        $Absents = Absent::where('group_id', $id)->where('day', $truncated)->get();
        return view('admin.absent.absentStudents', compact('Absents'));
    }
}
