<?php

namespace App\Http\Controllers\Executive;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**-------- get district------------*/
    public function getdistrict(){
        $districts = District::all();
        return view('executive.district', compact('districts'));
    }
}
