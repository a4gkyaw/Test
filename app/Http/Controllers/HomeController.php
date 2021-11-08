<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Customer;
use App\UserRole;
use Auth;
use App\Nrc;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = [''=>''] + UserRole::orderby('id')->pluck('name', 'name')->toArray();
        $nrcs = Nrc:: get();
        $nrc_code = [''=>''] + Nrc::orderby('nrc_code')->pluck('nrc_code', 'nrc_code')->toArray();
        $nrc_township = [''=>''] + Nrc::orderby('nrc_township')->pluck('nrc_township', 'nrc_township')->toArray(); 
        // dd($role);
        $approve = 3;
        if(Auth::user()->role=='admin'){
            $users = Customer::paginate(5);
            $search = '';
            return view('admin.home',compact('users','search','approve'));
        }elseif (Auth::user()->role=='user') {
            return view('admin.create',compact('nrc_code','nrc_township'));
        }
        else{
            return view('guest');
        }
    }

    public function getTownship(Request $request)
    {
      $data = Nrc::select('nrc_township')->where('nrc_code','=',$request->id)->get();

      return Response()->json($data);
    }
}
