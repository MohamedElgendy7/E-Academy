<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Group;
use App\Models\mainCategory;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $mainCategories = mainCategory::active()->get();
        $grades = Grade::active()->get();
        $groups = Group::active()->get();
        $students = Student::active()->get();
        return view('admin.dashboard', compact('mainCategories', 'grades', 'groups', 'students'));
    }
}
