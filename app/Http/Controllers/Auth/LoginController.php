<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use DB;
use Session;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        //dd($request);
        // return $request->only($this->username(), 'password');
        //$default = '0' ;
        //dd($request);
        return ['email'=>$request->{$this->username()},'password'=>$request->password,'status'=>'1'];

        // if(Auth::check()){
        //     User::where('email', $request->email)->update(['status' => $default]);
        // }
    }

    public function logout(Request $request)
    {
        
        
        $default = '1';
        $userID = Auth::User()->id;

    
        User::where('id', $userID)->update(['status' => $default]);
        //dd($user);

        $this->guard()->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();



        return $this->loggedOut($request) ?: redirect('/');
    }


    protected $maxAttempts = 2 ;
    protected $decayMinutes  = 3 ;
    //add new function for login validate 
    // public function login(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);

    //     $user = User::where('email', $request->input('email'))->first();

    //     if (auth()->guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
    //         $a = "a";
    //         $b = "b";
    //         $new_session_id = \Session::getId(); //get new session_id after user sign in
    //         //dd($new_session_id);
    //         if ($user->session_id != '') {
    //             $last_session = \Session::getHandler()->read($user->session_id);
    //             //echo "win tl";
    //             //dd($last_session);
    //             // if ($last_session) {
    //             //     if (\Session::getHandler()->destroy($user->session_id)) {

    //             //     }
    //             // }
    //         }
    //         else{
    //             dd($a);
    //         }

    //         User::where('id', $user->id)->update(['session_id' => $new_session_id]);

    //         $user = auth()->guard('web')->user();

    //         return redirect($this->redirectTo);
    //     }
    //     \Session::put('login_error', 'Your email and password wrong!!');
    //     return back();

    // }

    // public function logout(Request $request)
    // {
    //     \Session::flush();
    //     \Session::put('success', 'Logout Successful!');
    //     return redirect()->to('/login');
    // }
    //end here
}
