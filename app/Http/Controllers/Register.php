<?php

namespace App\Http\Controllers;

use App\Models\BusinessType;
use Illuminate\Http\Request;

class Register extends Controller
{
    public function index(){
        $business_type = BusinessType::all();
        

        return view('auth.register', compact('business_type'));
    }
}
