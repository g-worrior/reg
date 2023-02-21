<?php

namespace App\Http\Controllers\Admin;

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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class UserController extends Controller
{
    public function index()
    {
        $countuser = User::where('role_as', '=', '0')->count();

        $business = Business::with('users')->get();

        $users = User::where('role_as', '=', '0')
            ->join('districts', 'users.district_id', '=', 'districts.id')
            ->join('genders', 'users.gender_id', '=', 'genders.id')
            ->join('businesses', 'users.id', '=', 'businesses.user_id')
            ->join('categories', 'businesses.category_id', '=', 'categories.id')
            ->join('business_types', 'businesses.business_type_id', '=', 'business_types.id')
            ->get();

        $subscriptions = Subscription::join('users', 'subscription.user_id', '=', 'users.id')
            ->join('businesses', 'users.id', '=', 'businesses.user_id');
        return view('admin.customer', compact('users', 'countuser', 'subscriptions'));
    }
    public function dashboard()
    {
        $countuser = User::where('role_as', '=', '0')->count();
        $countadmin = User::where('role_as', '=', '1')->count();
        $countsubscribers = Subscription::where('state', '=', '1')->count();
        $countmales = User::where('gender_id', '=', '1')->where('role_as', '=', '0')->count();
        $countfemales = User::where('gender_id', '=', '2')->where('role_as', '=', '0')->count();

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
            'admin.dashboard',
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

    public function myprofile()
    {
        $users = User::join('districts', 'users.district_id', '=', 'districts.id')
            ->join('genders', 'users.gender_id', '=', 'genders.id')
            ->where('users.id', '=', Auth::id())
            ->select('users.*','genders.gender_name', 'districts.district_name')
            ->get();

        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.myprofile', compact('users', 'posts'));
    }

    public function myposts()
    {
        $users = User::join('districts', 'users.district_id', '=', 'districts.id')
            ->join('genders', 'users.gender_id', '=', 'genders.id')
            ->where('users.id', '=', Auth::id())
            ->select('users.*','genders.gender_name', 'districts.district_name')
            ->get();

        $posts = Post::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('admin.myposts', compact('users', 'posts'));
    }

    public function change_password()
    {
        $countuser = User::where('role_as', '=', '0')->count();
        $countadmin = User::where('role_as', '=', '1')->count();
        $users = User::join('districts', 'users.district_id', "=", 'districts.id')
            ->get();
        return view('admin.change_password', compact('users', 'countuser', 'countadmin'));
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ]);
        if ($request->isMethod('POST')) {
            $data = $request->all();
            if ($data['new_password'] == $data['confirm_password']) {

                $password = Auth()->User();
                $new_password = $data['new_password'];
                if (Hash::check($data['old_password'], $password->password)) {
                    //update password
                    $confirm_password = bcrypt($data['confirm_password']);
                    $password->update(['password' => $confirm_password]);
                    Toastr::success('Password Updated Successfully', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('Password Update Failed Incorrect old password', 'failed');
                    return redirect()->back();
                }
            } else {
                Toastr::error('Confirm passworrd not Match with New password!', 'failed');
                return redirect()->back();
            }
        }
    }

    /** ------ delete selected user----------*/
    public function deleteUser($user_id)
    {

        $user = User::find($user_id);

        $business = Business::where('user_id', $user_id)->first();

        $profile = public_path('images/user/' . $user->profile_picture);
        $certificate = public_path('images/business-cert/' . $business->business_certificate);
        $tax = public_path('images/tax-cert/' . $business->tax_clearance);
        $ppda = public_path('images/ppda/' . $business->ppda);
        $otherdocs = public_path('images/other-docs/' . $business->other_docs);

        if ($user->profile_picture) {
            unlink($profile);
        }
        if ($business->business_certificate) {
            unlink($tax);
        }
        if ($business->tax_clearance) {
            unlink($certificate);
        }

        if ($business->ppda) {
            unlink($ppda);
        }
        if ($business->other_docs) {
            unlink($otherdocs);
        }

        $user->delete();
        $business->delete();
        Toastr::success('User deleted successfully :)', 'Success');
        return redirect()->back();
    }

    /**--------view user for update----- */
    public function viewUser($user_id)
    {
        $users = User::join('districts', 'users.district_id', '=', 'districts.id')
            ->join('genders', 'users.gender_id', '=', 'genders.id')
            ->join('businesses', 'users.id', '=', 'businesses.user_id')
            ->join('categories', 'businesses.category_id', '=', 'categories.id')
            ->join('business_types', 'businesses.business_type_id', '=', 'business_types.id')
            ->get();
        $district = District::all();
        $gender = Gender::all();
        $business_type = BusinessType::all();
        $category = Category::all();

        return view('admin.member_details', compact('users', 'user_id', 'district', 'gender', 'business_type', 'category'));
    }

    /** ------ update selected user -------*/
    public function updateUser(Request $request, $user_id)
    {

        $user = User::find($user_id);

        $user->name = $request->input('fullname');
        $user->phonenumber = $request->input('phonenumber');
        $user->gender_id = $request->input('gender_id');
        $user->district_id = $request->input('district_id');


        //profile picture update
        if ($request->hasFile('profile_picture')) {

            //deletes old file
            $destination = 'images/user/' . $user->profile_picture;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $profile = $request->file('profile_picture');
            $extension = $profile->getClientOriginalExtension();
            $profile_pic = time() . '.' . $extension;
            $profile->move(public_path('images/user/'), $profile_pic);
            $user->profile_picture = $profile_pic;
        }

        //business certificate file update
        if ($request->hasFile('certificate')) {

            //deletes old file
            $destination = 'images/business-cert/' . $user->business_certificate;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $cert = $request->file('certificate');
            $extension = $cert->getClientOriginalExtension();
            $certificate = time() . '.' . $extension;
            $cert->move(public_path('images/business-cert/'), $certificate);
            Business::where('user_id', $user_id)->update([
                'business_certificate' => $certificate,
            ]);
        }

        //tax file update
        if ($request->hasFile('tax')) {

            //deletes old file
            $destination = 'images/tax-cert/' . $user->tax_clearance;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $taxfile = $request->file('tax');
            $extension = $taxfile->getClientOriginalExtension();
            $tax = time() . '.' . $extension;
            $taxfile->move(public_path('images/tax-cert/'), $tax);
            Business::where('user_id', $user_id)->update([
                'tax_clearance' => $tax,
            ]);
        }

        //ppda file update
        if ($request->hasFile('ppda')) {

            //deletes old file
            $destination = 'images/ppda/' . $user->ppda;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $ppdafile = $request->file('ppda');
            $extension = $ppdafile->getClientOriginalExtension();
            $ppda = time() . '.' . $extension;
            $ppdafile->move(public_path('images/ppda/'), $ppda);
            Business::where('user_id', $user_id)->update([
                'ppda' => $ppda,
            ]);
        }

        //other files attacked update
        if ($request->hasFile('otherdocs')) {

            //deletes old file
            $destination = 'images/other-docs/' . $user->other_docs;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $otherdocsfile = $request->file('otherdocs');
            $extension = $otherdocsfile->getClientOriginalExtension();
            $otherdocs = time() . '.' . $extension;
            $otherdocsfile->move(public_path('images/other-docs/'), $otherdocs);
            Business::where('user_id', $user_id)->update([
                'other_docs' => $otherdocs
            ]);
        }
        $user->update();


        Business::where('user_id', $user_id)->update([
            'business_name' => $request->business_name,
            'category_id' => $request->category_id,
            'business_type_id' => $request->business_type_id,
        ]);
        Toastr::success('Profile Updated Successfully', 'Success');
        return redirect()->back();
    }

    /**----- */
    public function Users()
    {
        $users = User::where('role_as', '!=', '0')
            ->join('districts', 'users.district_id', '=', 'districts.id')
            ->join('genders', 'users.gender_id', '=', 'genders.id')
            ->get();
        return view('admin.users', compact('users'));
    }

    /**----- to add user page-------*/
    public function addUser()
    {
        $district = District::all();
        $gender = Gender::all();
        return view('admin.add-user', compact('district', 'gender'));
    }

    /**------- add user to database from form*/
    public function addUsertoDB(Request $request)
    {
        $config= ['table'=>'users', 'length'=>11, 'prefix'=>'010'];
        $user_id = IdGenerator::generate($config);
        $profile_pic = NULL;
        $this->validate($request,[
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed','min:8'],
            'password_confirmation' => ['required', 'same:password'],
            'profile_picture' => ['mimes:jpeg,png,jpg', 'max:5200'],
            'phonenumber' => ['required', 'string', 'max:14', 'unique:users'],
            'district_id' => ['required'],
            'gender_id' => ['required'],
            'role' => ['required'],
        ]);
        
        // save profile pic
        if($request->hasfile('profile_picture')){

            $file = $request->file('profile_picture');
            $extension = $file->getClientOriginalExtension();
            $profile_pic = time().'.'.$extension;
            $file->move(public_path('images/user/'),$profile_pic);
        }
        $user = User::create([
            'id' =>$user_id,
            'name' => $request->fullname,
            'phonenumber' => $request->phonenumber,
            'district_id' =>$request->district_id,
            'gender_id' =>$request->gender_id,
            'profile_picture'=>$profile_pic,
            'email' => $request->email,
            'role_as' =>$request->role,
            'password' => bcrypt($request->password),
        ]);

        $district = District::all();
        $gender = Gender::all();
        $users = User::where('role_as', '!=', '0')
            ->join('districts', 'users.district_id', '=', 'districts.id')
            ->join('genders', 'users.gender_id', '=', 'genders.id')
            ->get();
        Toastr::success('User Added Successfully', 'Success');
        return view('admin.users', compact('users'));
    }
    
    /**------delete admin or executive user from database------ */
    public function deleteadminorexecutive($email)
    {
        $user_id = User::where('email', $email)->get();
        $user = User::find($user_id);
        $hasimage = User::where('email', $email)->whereNotNull('profile_picture')->exists();
        if ( User::where('email', $email)->whereNotNull('profile_picture')->exists()) 
        {
            $profile = public_path('images/user/' . $user->profile_picture);
            unlink($profile);
        }
        
        $user_id = User::where('email', $email)->delete();

        Toastr::success('User deleted successfully', 'Success');
        return redirect()->back();
    }
}
