<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Grade;
use App\Models\Group;
use App\Models\mainCategory;
use App\Models\Student;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function index()
    {

        $groups = Group::with('grades', 'main_category')->selection()->get();
        return view('admin.groups.index', compact('groups'));
    }


    public function create()
    {
        $categories = mainCategory::active()->get();
        $grades = Grade::active()->get();
        if ($categories->count() == 0) {
            return redirect()->route('admin.maincategories.create')->with(['error' => 'لا يوجد مقرات قم بأضافة مقر']);
        } elseif ($grades->count() == 0) {
            $categories = mainCategory::active()->get();
            return redirect()->route('admin.grades.create', compact('categories'))->with(['error' => 'لا يوجد صفوف قم بأضافة صف']);
        }
        return view('admin.groups.create', compact('categories', 'grades'));
    }


    public function store(GroupRequest $request)
    {
        try {

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            //check of !child
            $main_id = Grade::find($request->grade_id)->main_category_id;
            if ($main_id == $request->main_category_id) {
                Group::create($request->except(['_token']));
                return redirect()->back()->with(['success' => 'تم الاضافة بنجاح']);
            } else
                return redirect()->back()->with(['error' => 'هذا الصف لا ينتمي الي هذا المقر']);
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.groups')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function edit($id)
    {
        try {
            $categories = mainCategory::active()->get();
            $grades = Grade::active()->get();
            $groups = Group::selection()->find($id);
            //valid category id 
            if (!$groups) {
                return redirect()->route('admin.groups')->with(['error' => 'هذه المجموعة غير موجود']);
            }
            return view('admin.groups.edit', compact('groups', 'categories', 'grades'));
        } catch (\Exception $ex) {
            return redirect()->route('admin.groups')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function update(GroupRequest $request, $id)
    {
        try {
            // return $request;
            //check
            $groups = Group::find($id);
            if (!$groups) {
                return redirect()->route('admin.groups')->with(['error' => 'هذه المجموعة غير موجود']);
            }
            //update;

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            Group::where('id', $id)->update([
                'name' => $request->name,
                'active' => $request->active,
                'grade_id' => $request->grade_id,
                'main_category_id' => $request->main_category_id,
            ]);

            return redirect()->route('admin.groups')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.groups')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function destroy($id)
    {
        try {
            $groups = Group::find($id);
            if (!$groups)
                return redirect()->route('admin.groups', $id)->with(['error' => 'هذه المجموعة غير موجوده']);


            $status = $groups->active;
            if ($status ==  0) {
                $groups->delete();
                return redirect()->back()->with(['success' => 'تم حذف المجموعة بنجاح']);
            }
            return redirect()->back()->with(['error' => 'هذا القسم به متاجر قيد العمل ']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }


    public function changeStatus($id)
    {
        try {
            $Group = Group::find($id);
            if (!$Group)
                return redirect()->route('admin.groups', $id)->with(['error' => 'هذه المجموعة غير موجوده']);

            $status = $Group->active ==  0 ? 1 : 0;

            $Group->update(['active' => $status]);
            return redirect()->route('admin.groups')->with(['success' => 'تم تغير حالة المجموعة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.groups')->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }


    public function show($id)
    {
        $group = Group::with('main_category', 'grades')->find($id);
        $students = Student::active()->same($group->grades->id, $group->main_category->id, $id)->get();
        return view('admin.student.index', compact('students'));
    }
}
