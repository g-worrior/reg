<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    /**-------- get district------------*/
    public function getdistrict(){
        $districts = District::all();
        return view('admin.district', compact('districts'));
    }

    /**------- save district ---------- */
    public function insertdistrict(Request $request){
        $request->validate([
            'district_name' =>'required|string|max:100' 
        ]);
        DB::beginTransaction();
        try {
            $district = new District;
            $district->district_name = $request->district_name;
            $district->save();

            DB::commit();
            Toastr::success('Created New District Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Adding New District Failed', 'Error');
            return redirect()->back();
        }
    }


    /** ------------update district----------- */
    public function updatedistrict(Request $request){
        $request->validate([
            'district_name' =>'required|string|max:100' 
        ]);
        DB::beginTransaction();
        try {

            $update = [
                'id'          => $request->id,
                'district_name'        => $request->district_name,
            ];
            
            District::where('id',$request->id)->update($update);
            DB::commit();
            Toastr::success('Updated District successfully','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Update District fail','Error');
            return redirect()->back();
        }
    }

    /**------------ delete district--------- */
    public function deletedistrict(Request $request)
    {
        $request->validate([
            'id' =>'required|max:100' 
        ]);
        try {

            District::destroy($request->id);
            Toastr::success('District deleted successfully :)','Success');
            return redirect()->back();
        
        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('District delete fail','Error');
            return redirect()->back();
        }
    }

}
