<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\Group;
use App\Models\Month;
use App\Models\Student;
use Illuminate\Http\Request;

class CashController extends Controller
{
    public function index()
    {
        $months = Month::user()->get();
        return view('admin.cash.MonthIndex', compact('months'));
    }

    public function create($group_id)
    {
        try {
            $students = Group::with('students')->find($group_id)->students;
            if (Month::user()->count() == 0) {
                return redirect()->route('admin.cash.month.create')->with(['error' => 'قم بالتسجيل شهر اولاً']);
            }

            if ($students->count() == 0) {
                return redirect()->route('admin.student.create')->with(['error' => 'قم بأضافة طلاب اولاً']);
            }
            $months = Month::user()->active()->get();
            return view('admin.cash.create', compact('students', 'months'));
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'قد لا يوجد شهر لتسجيل مصروفات له']);
        }
    }

    public function store(Request $request)
    {
        try {

            $group_id = Student::find($request->student_id)->group_id;
            $cash = Cash::where('student_id', $request->student_id)->where('month', $request->month)->get();

            if ($cash->count() == 0) {
                Cash::create($request->except('_token'));
                return redirect()->route('admin.cash.create', $group_id)->with(['success' => 'تم تسجل الدفع']);
            }

            return redirect()->route('admin.cash.create', $group_id)->with(['error' => 'تم التسجيل من قبل']);
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.cash.create', $group_id)->with(['error' => 'حدث خطأ ما ']);
        }
    }
}
