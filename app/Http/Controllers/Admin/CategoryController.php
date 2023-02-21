<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**-------- get categories------------*/
    public function getcategory(){
        $categories = Category::all();
        return view('admin.business_categories', compact('categories'));
    }

    /**------- save category ---------- */
    public function insertcategory(Request $request){
        $request->validate([
            'category_name' =>'required|string|max:100' 
        ]);
        DB::beginTransaction();
        try {
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->save();

            DB::commit();
            Toastr::success('Created New category Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Addinf New category Failed', 'Error');
            return redirect()->back();
        }
    }


    /** ------------update category----------- */
    public function updatecategory(Request $request){
        $request->validate([
            'category_name' =>'required|string|max:100' 
        ]);
        DB::beginTransaction();
        try {

            $update = [
                'id'          => $request->id,
                'category_name'        => $request->category_name,
            ];
            
            Category::where('id',$request->id)->update($update);
            DB::commit();
            Toastr::success('Updated category successfully','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Update category fail','Error');
            return redirect()->back();
        }
    }

    /**------------ delete category--------- */
    public function deletecategory(Request $request)
    {
        $request->validate([
            'id' =>'required|max:100' 
        ]);
        try {

            Category::destroy($request->id);
            Toastr::success('category deleted successfully','Success');
            return redirect()->back();
        
        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('category delete fail','Error');
            return redirect()->back();
        }
    }

}
