<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request. and rendirecting users based on their role
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        // 1 is for admin
        if(Auth::user()->role_as == 0) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME0);    
        }
        // 0 for normal user
        else if(Auth::user()->role_as == 1){
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);    
        }
        else if(Auth::user()->role_as == 2){
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME2);    
        }
        else{
            return redirect('/login')->with('message', 'Please Log in');
        }

        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
