<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\Group;
use App\Models\Month;
use Illuminate\Http\Request;

class CashController extends Controller
{
    public function index()
    {
        $months = Month::paginate(PAGINATION_COUNT);
        return view('admin.cash.MonthIndex', compact('months'));
    }

    public function create($group_id)
    {
        $students = Group::with('students')->find($group_id)->students;
        if ($students->count() == 0) {
            return redirect()->route('admin.student.create')->with(['error' => 'قم بأضافة طلاب اولاً']);
        }
        $months = Month::active()->get();
        return view('admin.cash.create', compact('students', 'months'));
    }

    public function store(Request $request)
    {
        return $request;
        try {
            if (Month::count() == 0) {
                Cash::create($request->except('_token'));
                return redirect()->back()->with(['success' => 'تم تسجل الدفع']);
            }
            $months = Month::get();
            $arr = [];
            for ($i = 0; $i < $months->count(); $i++) {
                $arr[] = $months[$i]['name'];
            }
            if (!in_array($request->name, $arr)) {
                Cash::create($request->except('_token'));
                return redirect()->back()->with(['success' => 'تم تسجل الدفع']);
            }
        } catch (\Exception $ex) {
            return redirect()->route('admin.cash.create')->with(['error' => 'حدث خطأ ما ']);
        }
    }
}
