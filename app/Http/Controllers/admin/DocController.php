<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Doc;
use App\Models\Grade;
use Illuminate\Http\Request;

class DocController extends Controller
{
    public function index()
    {
        $Docs = Doc::get();
        return view('admin.doc.index', compact('Docs'));
    }

    public function create($grade_id)
    {
        return view('admin.doc.create', compact('grade_id'));
    }

    public function store(Request $request)
    {
        Doc::create($request->except(['_token']));
        return redirect()->route('admin.doc.index')->with(['success' => 'تم اضافة الملف']);
    }

    public function changeStatus($id)
    {
        try {
            $Video = Doc::find($id);
            if (!$Video)
                return redirect()->route('admin.doc.index')->with(['error' => 'هذا الملف غير موجود']);

            $status = $Video->active ==  0 ? 1 : 0;

            $Video->update(['active' => $status]);

            return redirect()->route('admin.doc.index')->with(['success' => 'تم تغير حالة الملف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.doc.index')->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }

    public function destroy($id)
    {
        try {
            $Doc = Doc::find($id);
            if (!$Doc)
                return redirect()->route('admin.doc.index')->with(['error' => 'هذا الملف غير موجود']);

            $status = $Doc->active;
            if ($status ==  0) {
                $Doc->delete();
                return redirect()->route('admin.doc.index')->with(['success' => 'تم حذف الملف بنجاح']);
            }
            return redirect()->route('admin.doc.index')->with(['error' => 'هذا الملف قيد العمل']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.doc.index')->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }
}
