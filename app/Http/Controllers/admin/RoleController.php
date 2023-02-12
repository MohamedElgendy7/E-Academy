<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        $admins = admin::user()->get();
        return view('admin.Roles.index', compact('admins'));
    }


    public function changeStatusRole($admin_id, $role)
    {
        try {
            $admin = admin::find($admin_id);

            $status = $admin->$role ==  0 ? 1 : 0;

            $admin->update([$role => $status]);

            return redirect()->route('admin.Roles.index', Auth::user()->super_id)->with(['success' => 'تم تغير صلاحية المستخدم بنجاح']);
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.Roles.index', Auth::user()->super_id)->with(['error' => 'هناك خطأ ما يرجي المحاولة مرة اخري']);
        }
    }
}
