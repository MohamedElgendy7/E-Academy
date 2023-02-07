<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\mainCategoryRequest;
use App\Models\Grade;
use App\Models\mainCategory;
use App\Observers\StudentObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class MainCategoriesController extends Controller
{
    public function index()
    {
        $categories = mainCategory::selection()->get();
        if (!$categories->count() > 0) {
            return redirect()->route('admin.maincategories.create')->with(['error' =>  ' لا يوجد مقرات قم بأضافة مقر ']);
        }
        return view('admin.maincategories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.maincategories.create');
    }


    public function store(mainCategoryRequest $request)
    {
        try {
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);

            mainCategory::create($request->except(['_token']));

            return redirect()->route('admin.maincategories')->with(['success' => 'تم الاضافة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function edit($id)
    {
        try {
            $mainCategory = mainCategory::selection()->find($id);
            //valid category id 
            if (!$mainCategory) {
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا المقر غير موجود']);
            }
            return view('admin.maincategories.edit', compact('mainCategory'));
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function update(mainCategoryRequest $request, $id)
    {
        try {
            //check
            $main_category = mainCategory::find($id);
            if (!$main_category) {
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا المقر غير موجود']);
            }
            //update;
            if ($request->has('active'))
                mainCategory::where('id', $id)->update([
                    'active' => $request->active,
                ]);
            mainCategory::where('id', $id)->update([
                'name' => $request->name,
            ]);

            return redirect()->route('admin.maincategories')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطأ ما']);
        }
    }


    public function destroy($id)
    {
        try {
            $category = mainCategory::with('grades', 'groups', 'students')->find($id);
            if (!$category)
                return redirect()->route('admin.maincategories', $id)->with(['error' => 'هذا المقر غير موجوده']);

            if ($category->grades->count() > 0 && $category->groups->count() > 0 && $category->students->count() > 0 && $category->active == 1) {
                return redirect()->route('admin.maincategories', $id)->with(['error' => 'هذا المقر قيد العمل   ']);
            }

            $category->delete();
            return redirect()->route('admin.maincategories')->with(['success' => 'تم حذف المقر بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }


    public function changeStatus($id)
    {
        try {
            $category = mainCategory::find($id);
            if (!$category)
                return redirect()->route('admin.maincategories', $id)->with(['error' => 'هذه المقر غير موجوده']);

            $status = $category->active ==  0 ? 1 : 0;

            $category->update(['active' => $status]);

            return redirect()->route('admin.maincategories')->with(['success' => 'تم تغير حالة المقر بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }

    public function show($id)
    {
        try {
            $mainCategory_id = mainCategory::find($id)->id;
            $grades = Grade::active()->where('main_category_id', $mainCategory_id)->get();
            if ($grades->count() == 0) {
                return redirect()->route('admin.grades.create', $id)->with(['error' => 'قم بأضافة صفوف اولاً']);
            }
            return view('admin.grades.index', compact('grades'));
        } catch (\Exception $ex) {
            //
        }
    }
}
