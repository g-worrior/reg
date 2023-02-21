<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessType;
use App\Models\Category;
use App\Models\District;
use App\Models\Gender;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $business_type = BusinessType::all();
        $category = Category::all();
        $district = District::all();
        $gender = Gender::all();
        return view('auth.register', compact('business_type', 'category', 'district', 'gender'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $config= ['table'=>'users', 'length'=>11, 'prefix'=>'010'];
        $user_id = IdGenerator::generate($config);
        $ppda = NULL;
        $profile_pic = NULL;
        $otherdocs = NULL;


        $this->validate($request,[
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed','min:8'],
            'password_confirmation' => ['required', 'same:password'],
            'profile' => ['mimes:jpeg,png,jpg', 'max:5200'],
            'phonenumber' => ['required', 'string', 'max:14', 'unique:users'],
            'district_id' => ['required'],
            'gender_id' => ['required'],
            'business_name' => ['required', 'string', 'max:255'],
            'category_id' => ['required'],
            'business_type_id' => ['required'],
            'tax' => ['required', 'mimes:jpeg,png,jpg,pdf', 'max:5200'],
            'certificate' => ['required', 'mimes:jpeg,png,jpg,pdf', 'max:5200'],
            'ppda' => ['mimes:jpeg,png,jpg,pdf', 'max:5200'],
            'otherdocs' => ['mimes:jpeg,png,jpg,pdf', 'max:5200'],
        ]);
        
        // save profile pic
        if($request->hasfile('profile')){

            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension();
            $profile_pic = time().'.'.$extension;
            $file->move(public_path('images/user/'),$profile_pic);
        }

        // save tax document
        if($request->hasfile('tax')){

            $file = $request->file('tax');
            $extension = $file->getClientOriginalExtension();
            $tax = time().'.'.$extension;
            $file->move(public_path('images/tax-cert/'),$tax);
        }

        // save business certificate
        if($request->hasfile('certificate')){

            $file = $request->file('certificate');
            $extension = $file->getClientOriginalExtension();
            $business_cert = time().'.'.$extension;
            $file->move(public_path('images/business-cert/'),$business_cert);
        }

        
        //save ppda
        if($request->hasfile('ppda')){

            $file = $request->file('ppda');
            $extension = $file->getClientOriginalExtension();
            $ppda = time().'.'.$extension;
            $file->move(public_path('images/ppda/'),$ppda);
        } 
        
        
        // save other docs
        if($request->hasfile('otherdocs')){

            $file = $request->file('otherdocs');
            $extension = $file->getClientOriginalExtension();
            $otherdocs = time().'.'.$extension;
            $file->move(public_path('images/other-docs/'),$otherdocs);
        }

        $user = User::create([
            'id' =>$user_id,
            'name' => $request->fullname,
            'phonenumber' => $request->phonenumber,
            'district_id' =>$request->district_id,
            'gender_id' =>$request->gender_id,
            'profile_picture'=>$profile_pic,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        Business::create([
            'user_id' =>$user_id,
            'business_name' =>$request->business_name,
            'category_id' =>$request->category_id,
            'business_type_id' =>$request->business_type_id,
            'tax_clearance' =>$tax,
            'business_certificate' =>$business_cert,
            'ppda' =>$ppda,
            'other_docs' =>$otherdocs
        ]);
        
     

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('success', 'Registered Successfull');
    }
}
