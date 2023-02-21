<?php

namespace App\Http\Controllers\Executive;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     /**-------- get categories------------*/
     public function getcategory(){
        $categories = Category::all();
        return view('executive.business_categories', compact('categories'));
    }
}
