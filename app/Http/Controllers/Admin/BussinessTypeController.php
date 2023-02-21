<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessType;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BussinessTypeController extends Controller
{
        /**-------- get categories------------*/
        public function gettype(){
            $types = BusinessType::all();
            return view('admin.business_types', compact('types'));
        }
    
        /**------- save business_type ---------- */
        public function inserttype(Request $request){
            $request->validate([
                'business_type_name' =>'required|string|max:100' 
            ]);
            DB::beginTransaction();
            try {
                $business_type = new BusinessType();
                $business_type->business_type_name = $request->business_type_name;
                $business_type->save();
    
                DB::commit();
                Toastr::success('Created New Business Type Successfully', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                Toastr::error('Adding New business_type Failed', 'Error');
                return redirect()->back();
            }
        }
    
    
        /** ------------update business_type----------- */
        public function updatetype(Request $request){
            $request->validate([
                'business_type_name' =>'required|string|max:100' 
            ]);
            DB::beginTransaction();
            try {
    
                $update = [
                    'id'          => $request->id,
                    'business_type_name'        => $request->business_type_name,
                ];
                
                BusinessType::where('id',$request->id)->update($update);
                DB::commit();
                Toastr::success('Updated Business Ttype successfully :)','Success');
                return redirect()->back();
            } catch(\Exception $e) {
                DB::rollback();
                Toastr::error('Update Business Type fail','Error');
                return redirect()->back();
            }
        }
    
        /**------------ delete business_type--------- */
        public function deletetype(Request $request)
        {
            $request->validate([
                'id' =>'required|max:100' 
            ]);
            try {
    
                BusinessType::destroy($request->id);
                Toastr::success('Business Type deleted successfully','Success');
                return redirect()->back();
            
            } catch(\Exception $e) {
    
                DB::rollback();
                Toastr::error('Business Type delete fail','Error');
                return redirect()->back();
            }
        }
}
