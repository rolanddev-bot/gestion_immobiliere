<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    

    use AuthenticatesUsers {
        logout as doLogout;
    }

    public function logout(Request $request)
    {
        $this->doLogout($request);

        return view('pages.verifier_logout');
    }

    
	
    public function authenticated(Request $request, $user)
    {
        if (isset($user)) {
            return redirect('Dashbord');
        }
    }

    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
