<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('fldIsDeleted', 0)
            ->orderBy('fldSeqNo')
            ->get(['fldID', 'fldName']); // Keep response lightweight
    
        return response()->json($categories);
    }
    
}
