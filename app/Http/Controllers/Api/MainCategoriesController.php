<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\mainCategory;
use App\Traits\generalTrait;
use Illuminate\Http\Request;

class MainCategoriesController extends Controller
{
    use generalTrait;

    public function index(Request $request)
    {
        $categories = mainCategory::find($request->id);
        if (!$categories) {
            return $this->returnError('E001', 'هذا القسم غير موجود');
        }
        return response()->json($categories);
    }
}
