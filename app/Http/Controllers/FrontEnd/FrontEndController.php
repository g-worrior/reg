<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessType;
use App\Models\Category;
use App\Models\District;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Brian2694\Toastr\Toastr as ToastrToastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class FrontEndController extends Controller
{
    public function dashboard()
    {

        $users = User::join('districts', 'users.district_id', '=', 'districts.id')
            ->join('genders', 'users.gender_id', '=', 'genders.id')
            ->join('businesses', 'users.id', '=', 'businesses.user_id')
            ->join('categories', 'businesses.category_id', '=', 'categories.id')
            ->join('business_types', 'businesses.business_type_id', '=', 'business_types.id')
            ->get();
        // Toastr::success('Welcome', 'Success');
        return view('frontend.dashboard', compact('users'));
    }

    public function myinfo()
    {

        $users = User::join('districts', 'users.district_id', '=', 'districts.id')
            ->join('genders', 'users.gender_id', '=', 'genders.id')
            ->join('businesses', 'users.id', '=', 'businesses.user_id')
            ->join('categories', 'businesses.category_id', '=', 'categories.id')
            ->join('business_types', 'businesses.business_type_id', '=', 'business_types.id')
            ->get();
        return view('frontend.myinfo', compact('users'));
    }

    public function subscription()
    {

        return view('frontend.subscription');
    }


    public function updateprofile()
    {
        $users = User::join('districts', 'users.district_id', '=', 'districts.id')
            ->join('genders', 'users.gender_id', '=', 'genders.id')
            ->join('businesses', 'users.id', '=', 'businesses.user_id')
            ->join('categories', 'businesses.category_id', '=', 'categories.id')
            ->join('business_types', 'businesses.business_type_id', '=', 'business_types.id')
            ->get();
        $district = District::all();
        $business_types = BusinessType::all();
        $categories = Category::all();

        return view('frontend.updateprofile', compact('users', 'district', 'business_types', 'categories'));
    }

    public function profileupdate(Request $request)
    {

        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        if($request->has('fullname')){
            $user->name = $request->input('fullname');
        }
        if($request->has('phonenumber')){
            $user->phonenumber = $request->input('phonenumber');
        }
        if($request->hasAny('district_id')){
            $user->district_id = $request->input('district_id');
        }

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
            Business::where('user_id', Auth::user()->id)->update([
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
            Business::where('user_id', Auth::user()->id)->update([
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
            Business::where('user_id', Auth::user()->id)->update([
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
            Business::where('user_id', Auth::user()->id)->update([
                'other_docs' => $otherdocs
            ]);
        }
        $user->update();

        if ($request->has('business_name')) {
            Business::where('user_id', Auth::user()->id)->update([
                'business_name' => $request->business_name,
            ]);
        }

        if ($request->hasAny('business_type_id')) {
            Business::where('user_id', Auth::user()->id)->update([
                'business_type_id' => $request->business_type_id,
            ]);
        }

        if ($request->hasAny('category_id')) {
            Business::where('user_id', Auth::user()->id)->update([
                'category_id' => $request->category_id,
            ]);
        }
        Toastr::success('Profile Updated Successfully', 'Success');
        return redirect()->back()->with('success', 'Profile Updated');
    }

    public function change_password()
    {
        $countuser = User::where('role_as', '=', '0')->count();
        $countadmin = User::where('role_as', '=', '1')->count();
        $users = User::join('districts', 'users.district_id', "=", 'districts.id')
            ->get();
        return view('frontend.change_password', compact('users', 'countuser', 'countadmin'));
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
                    Toastr::error('Password Update Failed', 'failed');
                    return redirect()->back();
                }
            } else {
                Toastr::error('Password Does not Match!', 'failed');
                return redirect()->back();
            }
        }
    }
}
