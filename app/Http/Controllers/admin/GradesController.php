<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest;
use App\Models\Grade;
use App\Models\Group;
use App\Models\mainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\If_;

class GradesController extends Controller
{
    public function index()
    {
        $grades = Grade::with('main_category', 'groups')->selection()->get();
        if ($grades->count() > 0) {
            return view('admin.grades.index', compact('grades'));
        }
        return redirect()->route('admin.maincategories')->with(['error' => 'لا يوجد صفوف قم . بأضافة صف']);
    }


    public function create($cat_id)
    {
        $category = mainCategory::find($cat_id);
        return view('admin.grades.create', compact('category'));
    }


    public function store(GradeRequest $request)
    {
        try {

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            Grade::create($request->except(['_token']));

            return redirect()->route('admin.grades')->with(['success' => 'تم الاضافة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.grades')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function edit($id)
    {
        try {
            $Grade = Grade::selection()->find($id);
            $categories = mainCategory::get();
            //valid category id 
            if (!$Grade)
                return redirect()->route('admin.grades')->with(['error' => 'هذا الصف غير موجود']);

            return view('admin.grades.edit', compact('Grade', 'categories'));
        } catch (\Exception $ex) {
            return redirect()->route('admin.grades')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function update(GradeRequest $request, $id)
    {
        try {
            //check
            $main_category = Grade::find($id);
            if (!$main_category) {
                return redirect()->route('admin.grades')->with(['error' => 'هذا الصف غير موجود']);
            }

            Grade::where('id', $id)->update([
                'name' => $request->name,
                'main_category_id' => $request->main_category_id,
                // 'active' => $request->active,
            ]);

            return redirect()->route('admin.grades')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.grades')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function destroy($id)
    {
        try {
            $grade = Grade::with('groups', 'students')->find($id);
            if (!$grade)
                return redirect()->route('admin.grades')->with(['error' => 'هذه الصف غير موجوده']);

            if ($grade->groups->count() > 0 && $grade->students->count() > 0 && $grade->active == 1) {
                return redirect()->route('admin.grades')->with(['error' => 'هذا الصف قيد العمل ']);
            }

            $grade->delete();
            return redirect()->route('admin.grades')->with(['success' => 'تم حذف الصف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }


    public function changeStatus($id)
    {
        try {
            $grade = Grade::find($id);
            if (!$grade)
                return redirect()->back()->with(['error' => 'هذه الصف غير موجوده']);

            $status = $grade->active ==  0 ? 1 : 0;

            $grade->update(['active' => $status]);
            return redirect()->back()->with(['success' => 'تم تغير حالة الصف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }

    public function show($id)
    {
        $grades = Grade::with('main_category', 'groups')->find($id);
        $groups = Group::active()->same($id, $grades->main_category->id)->get();
        if ($groups->count() > 0) {
            return view('admin.groups.index', compact('groups'));
        }
        return redirect()->back()->with(['error' => 'قم بأضافة مجموعة اولاً']);
    }
}
