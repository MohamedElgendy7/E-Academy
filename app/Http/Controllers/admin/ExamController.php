<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::get();
        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        return view('admin.exams.create');
    }

    public function store(Request $request)
    {
        Exam::create($request->except('_token'));
        return redirect()->route('admin.exam')->with(['success' => 'تم اضافة الامتحان']);
    }

    public function edit($id)
    {
        try {
            $exam = Exam::find($id);
            //valid category id 
            if (!$exam) {
                return redirect()->route('admin.exam')->with(['error' => 'هذا المقر غير موجود']);
            }
            return view('admin.exams.edit', compact('exam'));
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.exam')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            //check
            $exam = Exam::find($id);
            if (!$exam) {
                return redirect()->route('admin.exam')->with(['error' => 'هذا الامتحان غير موجود']);
            }

            Exam::where('id', $id)->update([
                'name' => $request->name,
            ]);

            return redirect()->route('admin.exam')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.exam')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function destroy($id)
    {
        try {
            $exam = Exam::find($id);
            if (!$exam)
                return redirect()->route('admin.exam', $id)->with(['error' => 'هذا الامتحان غير موجود=']);

            $exam->delete();
            return redirect()->route('admin.exam')->with(['success' => 'تم الحذف بنجاح']);
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.exam')->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }
}
