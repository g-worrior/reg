<?php

namespace App\Http\Controllers\Executive;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Gender;
use App\Models\Business;
use App\Models\Category;
use App\Models\District;
use App\Models\BusinessType;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $countuser = User::where('role_as', '=', '0')->count();

        $business = Business::with('users')->get();

        $users = User::where('role_as', '=', '0')
        ->join('districts', 'users.district_id', '=','districts.id')
        ->join('genders', 'users.gender_id', '=', 'genders.id')
        ->join('businesses', 'users.id', '=', 'businesses.user_id')
        ->join('categories', 'businesses.category_id', '=', 'categories.id')
        ->join('business_types', 'businesses.business_type_id', '=', 'business_types.id')
        ->get();

        $subscriptions = Subscription::join('users', 'subscription.user_id', '=', 'users.id')
        ->join('businesses', 'users.id', '=', 'businesses.user_id');
        return view('executive.customer', compact('users', 'countuser','subscriptions'));
    }
    public function dashboard(){
        $countuser = User::where('role_as', '=', '0')->count();
        $countadmin = User::where('role_as', '=', '1')->count();

        $countsubscribers = Subscription::where('state', '=', '1')->count();

        $countmales = User::where('gender_id', '=', '1')->where('role_as', '=', '0' )->count();
        $countfemales = User::where('gender_id', '=', '2')->where('role_as', '=', '0' )->count();

        $users = User::with('districts')->get();
        $data = User::select('id', 'created_at')->where('role_as', '=', '0')->get()->groupBy(function ($data) {
            return Carbon::parse($data->created_at)->format('M');
        });
        $months = [];
        $monthCount = [];
        foreach ($data as $month => $values) {
            $months[] = $month;
            $monthCount[] = count($values);
        }
        return view(
            'executive.dashboard',
            compact(
                [
                    'users',
                    'countuser',
                    'countadmin',
                    'countsubscribers',
                    'countfemales',
                    'countmales',
                    'data',
                    'months',
                    'monthCount'
                ]
            )
        );
    }

    public function myprofile(){
        $users = User::join('districts', 'users.district_id', '=', 'districts.id')
        ->join('genders', 'users.gender_id', '=', 'genders.id')
        ->where('users.id', '=', Auth::id())
        ->select('users.*','genders.gender_name', 'districts.district_name')
        ->get();

        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('executive.myprofile', compact('users', 'posts'));
    }

    public function change_password()
    {
        $countuser = User::where('role_as', '=', '0')->count();
        $countadmin = User::where('role_as', '=', '1')->count();
        $users = User::join('districts', 'users.district_id', "=", 'districts.id')
            ->get();
        return view('executive.change_password', compact('users', 'countuser', 'countadmin'));
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ]);
        if($request->isMethod('POST')){
            $data = $request->all();
            if($data['new_password'] == $data['confirm_password']){
                
                $password = Auth()->User();
                $new_password = $data['new_password'];
                if(Hash::check($data['old_password'], $password->password)){
                    //update password
                    $confirm_password = bcrypt($data['confirm_password']);
                    $password->update(['password'=>$confirm_password]);
                    Toastr::success('Password Updated Successfully', 'Success');
                    return redirect()->back();
                }
                else{
                    Toastr::error('Password Update Failed', 'failed');
                    return redirect()->back();
                }

            }
            else{
                Toastr::error('Password Does not Match!', 'failed');
                return redirect()->back();
            }
        }
    }

     /**--------view user for update----- */
    public function viewUser($user_id){
        $users = User::join('districts', 'users.district_id', '=','districts.id')
       ->join('genders', 'users.gender_id', '=', 'genders.id')
       ->join('businesses', 'users.id', '=', 'businesses.user_id')
       ->join('categories', 'businesses.category_id', '=', 'categories.id')
       ->join('business_types', 'businesses.business_type_id', '=', 'business_types.id')
       ->get();
       $district = District::all();
       $gender = Gender::all();
       $business_type = BusinessType::all();
       $category = Category::all();
 
        return view('executive.member_details', compact('users','user_id', 'district', 'gender', 'business_type', 'category'));
    }
}
