<?php

namespace App\Http\Controllers\Executive;

use App\Http\Controllers\Controller;
use App\Models\BusinessType;
use Illuminate\Http\Request;

class BussinessTypeController extends Controller
{
     /**-------- get categories------------*/
     public function gettype(){
        $types = BusinessType::all();
        return view('executive.business_types', compact('types'));
    }
}
