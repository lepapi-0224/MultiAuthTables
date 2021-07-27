<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'contact';
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected function redirectTo()
    {
        // role 1 == admin
        if (Auth::user()->roles == 1 ) {
            return '/admin';
        }

        // role 2 == manager
        if (Auth::user()->roles == 2 ) {
            return '/manager';
        }

        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:employee')->except('logout');
    }

    public function showEmployeeLoginForm()
    {
        return view('auth.login', ['url' => 'employee']);
    }

    public function employeeLogin(Request $request)
    {
        $this->validate($request, [
            'contact'   => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('employee')->attempt(['contact' => $request->contact, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/employee');
        }
        return back()->withInput($request->only('contact', 'remember'));
    }
}
