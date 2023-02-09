<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Month;
use Illuminate\Http\Request;

class MonthController extends Controller
{
    public function create()
    {
        return view('admin.cash.MonthCreate');
    }


    public function store(Request $request)
    {
        // try {
        if (Month::count() == 0) {
            Month::create($request->except('_token'));
            return redirect()->route('admin.cash.month.index')->with(['success' => 'تم اضافة الشهر']);
        }
        $months = Month::user()->get();
        $arr = [];
        for ($i = 0; $i < $months->count(); $i++) {
            $arr[] = $months[$i]['name'];
        }
        if (!in_array($request->name, $arr)) {
            Month::create($request->except('_token'));
            return redirect()->route('admin.cash.month.index')->with(['success' => 'تم اضافة الشهر']);
        }
        // } catch (\Exception $ex) {
        //     return $ex;
        //     return redirect()->route('admin.cash.month.index')->with(['error' => 'حدث خطأ ما ']);
        // }
    }


    public function changeStatus($id)
    {
        try {
            $month = Month::find($id);
            if (!$month)
                return redirect()->route('admin.cash.month.index', $id)->with(['error' => 'هذا الشهر  غير موجود']);

            $status = $month->active ==  0 ? 1 : 0;

            $month->update(['active' => $status]);
            return redirect()->route('admin.cash.month.index')->with(['success' => 'تم تغير حالة الشهر بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.cash.month.index')->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }

    public function destroy($id)
    {
        try {
            $month = Month::find($id);
            if (!$month)
                return redirect()->route('admin.cash.month.index', $id)->with(['error' => 'هذا الشهر غير موجود']);


            $status = $month->active;
            if ($status ==  0) {
                $month->delete();
                return redirect()->route('admin.cash.month.index')->with(['success' => 'تم حذف الشهر بنجاح']);
            }
            return redirect()->route('admin.cash.month.index', $id)->with(['error' => 'هذا الشهر قيد العمل   ']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.cash.month.index')->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }
}
