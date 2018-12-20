<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(),
                                    [
                                        'email' => 'required|exists:users,email',
                                        'password' => 'required'
                                    ]
                                );
        $check_email_confirm = User::where('email', $request->email)->first();

        if($validator->fails()) {
            $result = ['msg' => 'Login Failed', 'type' => 'warning', 'url' => '#'];
        } else {

            if($check_email_confirm->email_confirm == 0) {
                $result = ['msg' => 'You need to confirm your account. We have sent you an activation code, please check your email.', 'type' => 'success', 'url' => '#'];
            } else {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $result = ['msg' => 'Login Success', 'type' => 'success', 'url' => $this->redirectTo];
                } else {
                    $result = ['msg' => 'Wrong password .', 'type' => 'warning', 'url' => '#'];
                }

            }

        }
        return response()->json($result);
    }

}
