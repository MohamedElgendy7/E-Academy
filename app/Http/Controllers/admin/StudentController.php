<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Cash;
use App\Models\Grade;
use App\Models\Group;
use App\Models\mainCategory;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('mainCategory', 'groups', 'grades')->selection()->get();
        return view('admin.student.index', compact('students'));
    }


    public function create()
    {
        $main_category = mainCategory::active()->get();
        $groups = Group::active()->get();
        $grades = Grade::active()->get();
        if ($main_category->count() == 0) {
            return redirect()->route('admin.maincategories.create')->with(['error' => 'لا يوجد مقرات قم بأضافة مقر']);
        } elseif ($grades->count() == 0) {
            $categories = mainCategory::active()->get();
            return redirect()->route('admin.grades.create', compact('categories'))->with(['error' => 'لا يوجد صفوف قم بأضافة صف']);
        } elseif ($groups->count() == 0) {
            $categories = mainCategory::active()->get();
            $grades = Grade::active()->get();
            return redirect()->route('admin.groups.create', compact('categories', 'grades'))->with(['error' => 'لا يوجد مجموعات قم بأضافة مجموعة']);
        }
        return view('admin.student.create', compact('main_category', 'groups', 'grades'));
    }


    public function store(StudentRequest $request)
    {
        try {
            // return $request;
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
            //check
            $main_category = Student::find($id);
            if (!$main_category) {
                return redirect()->route('admin.student')->with(['error' => 'هذا الصف غير موجود']);
            }
            //update;

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
            $category = Student::find($id);
            if (!$category)
                return redirect()->route('admin.student', $id)->with(['error' => 'هذه الصف غير موجوده']);

            $category->delete();

            return redirect()->route('admin.student')->with(['success' => 'تم حذف الصف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.student')->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
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
}
