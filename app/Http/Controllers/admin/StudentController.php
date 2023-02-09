<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Cash;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Group;
use App\Models\mainCategory;
use App\Models\Student;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\If_;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('mainCategory', 'groups', 'grades')->user()->selection()->get();
        if ($students->count() == 0) {
            return redirect()->route('admin.maincategories')->with(['error' => 'قم بأضافة طالب اولاً']);
        }
        return view('admin.student.index', compact('students'));
    }

    public function create($group_id)
    {
        $group = Group::active()->find($group_id);
        return view('admin.student.create', compact('group'));
    }


    public function store(StudentRequest $request)
    {
        try {
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);

            $grade = Grade::with('groups')->find($request->grade_id);
            $main_category_id = $grade->main_category_id;
            $group = Group::find($request->group_id);
            if ($main_category_id == $request->main_category_id) {
                if ($group->grade_id == $request->grade_id) {
                    Student::create($request->except(['_token']));
                    return redirect()->back()->with(['success' => 'تم الاضافة بنجاح']);
                } else
                    return redirect()->back()->with(['error' => 'هذه المجموعة لا تنتمي الي هذا الصف']);
            } else
                return redirect()->back()->with(['error' => 'هذا الصف لا ينتمي الي هذا المقر']);
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.student')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function edit($id)
    {
        try {
            $student = Student::active()->selection()->find($id);
            $grades = Grade::active()->get();
            $mainCategory = mainCategory::active()->get();
            $groups = Group::active()->get();

            if (!$student) {
                return redirect()->route('admin.student')->with(['error' => 'هذا الصف غير موجود']);
            }
            return view('admin.student.edit', compact('grades', 'student', 'mainCategory', 'groups'));
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.student')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function update(StudentRequest $request, $id)
    {
        try {
            $main_category = Student::find($id);
            if (!$main_category) {
                return redirect()->route('admin.student')->with(['error' => 'هذا الصف غير موجود']);
            }

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            Student::where('id', $id)->update([
                'name' => $request->name,
                'active' => $request->active,
            ]);

            return redirect()->route('admin.student')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.student')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function destroy($id)
    {
        try {
            $Student = Student::find($id);
            if (!$Student)
                return redirect()->route('admin.groups')->with(['error' => 'هذه الطالب غير موجوده']);

            $image = public_path('qrcodes/' . $id . '.png');

            if (file_exists($image)) {
                unlink($image);
            }
            $Student->delete();

            return redirect()->route('admin.groups')->with(['success' => 'تم حذف الطالب بنجاح']);
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.groups')->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }


    public function changeStatus($id)
    {
        try {
            $grade = Student::find($id);
            if (!$grade)
                return redirect()->route('admin.student', $id)->with(['error' => 'هذه الصف غير موجوده']);

            $status = $grade->active ==  0 ? 1 : 0;

            $grade->update(['active' => $status]);
            return redirect()->route('admin.student')->with(['success' => 'تم تغير حالة الصف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.student')->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }

    public function profile($id)
    {

        $student = Student::with('absent', 'degree')->find($id);
        $absent = $student->absent;
        $degrees = $student->degree;
        $cashs = $student->cash;
        return view('admin.student.profile', compact('student', 'absent', 'degrees', 'cashs'));
    }

    public function show($id)
    {
        $group = Group::with('main_category', 'grades')->find($id);
        $students = Student::active()->same($group->grades->id, $group->main_category->id, $id)->get();
        if ($students->count() > 0) {
            return view('admin.student.index', compact('students'));
        }
        return redirect()->route('admin.student.create', $id)->with(['error' => 'قم بأضافة طالب اولاً']);
    }
}
