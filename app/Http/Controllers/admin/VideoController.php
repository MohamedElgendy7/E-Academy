<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::get();
        return view('admin.video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.video.create');
    }

    public function store(Request $request)
    {
        Video::create($request->except(['_token']));
        return redirect()->route('admin.video.index')->with(['success' => 'تم اضافة الفيديو']);
    }

    public function changeStatus($id)
    {
        try {
            $Video = Video::find($id);
            if (!$Video)
                return redirect()->route('admin.video.index')->with(['error' => 'هذا الفيديو غير موجود']);

            $status = $Video->active ==  0 ? 1 : 0;

            $Video->update(['active' => $status]);

            return redirect()->route('admin.video.index')->with(['success' => 'تم تغير حالة الفيديو بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.video.index')->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }

    public function destroy($id)
    {
        try {
            $Video = Video::find($id);
            if (!$Video)
                return redirect()->route('admin.video.index')->with(['error' => 'هذا الفيديو غير موجود']);

            $status = $Video->active;
            if ($status ==  0) {
                $Video->delete();
                return redirect()->route('admin.video.index')->with(['success' => 'تم حذف الفيديو بنجاح']);
            }
            return redirect()->route('admin.video.index')->with(['error' => 'هذا الفيديو قيد العمل   ']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.video.index')->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }
}
