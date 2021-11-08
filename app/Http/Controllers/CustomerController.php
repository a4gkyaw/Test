<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use File;
use DB;
use Validator,Redirect,Response;
use App\Nrc;
use App\Customer;
use App\User;
use App\UserRole;
use Excel;
use App\Exports\CustomerList;
/**
 * 
 */
class CustomerController extends Controller
{
	 public function create()
	 {
	 	//echo "win lrr";
	 	$nrcs = Nrc:: get();
        $nrc_code = [''=>''] + Nrc::orderby('nrc_code')->pluck('nrc_code', 'nrc_code')->toArray();
        $nrc_township=[''=>''] + Nrc::orderby('nrc_township')->pluck('nrc_township', 'nrc_township')->toArray();

	 	return view('admin.create',compact('nrc_code','nrc_township'));
	 }

	 public function store(Request $request)
	 {
	 	//
	 	$nrc = $request->nrc_code.'/'.$request->nrc_township.'('.$request->nrc_type.')'.$request->nrc_number;
	 	$address = $request->no.'-'.$request->street.'-'.$request->township;
	 	$user = new Customer ([
	 		'name'=>$request->name,
			'address'=>$address,
			'email'=>$request->email,
			'position'=>$request->position,
			'nrc'=>$nrc,
			'join_date'=>$request->join_date
	 	]);
	 	$user->save();
	 	return redirect('/home');
	 	//dd($address);
	 }
	 public function edit(Request $request,$id)
	 {
	 	//echo "edit tok ml";
	 	$regex = '/^(\d+)\/([a-zA-Z]+)\(([A-Z][a-z]*)\)(\d{6})$/i';
		$natId = Customer::where('id', '=', $id)       //  12/PaZaTa(N)032957
            			 ->value('nrc');
        $match = preg_match($regex, $natId, $groups);
        $old_nrc_code = $groups[1];
        $old_nrc_township = $groups[2];
        $old_nrc_type = $groups[3];
        $old_nrc_number = $groups[4];
	 	$address = DB::table('customers')->where('id','=',$id)->value('address');
		if($address){
		$arr = explode("-", $address);

		//dd($groups);
		$no= $arr[0];
		$road= $arr[1];
		$township = $arr[2];
		}else{
			$no = '';
			$road = '';
			$township = '';
		}
	 	$users = DB::table('customers')->where('id',$id)->get();
	 	$nrc_code = [''=>''] + Nrc::orderby('nrc_code')->pluck('nrc_code', 'nrc_code')->toArray();
        $nrc_township=[''=>''] +Nrc::orderby('nrc_township')->pluck('nrc_township', 'nrc_township')->toArray();

	 	return view('admin.edit',compact('users','nrc_code','nrc_township','no','road','township','old_nrc_code','old_nrc_township','old_nrc_type','old_nrc_number'));

	 }
	 public function update(Request $request,$id)
	 {
	 	//dd($request);
	 	$nrc = $request->nrc_code.'/'.$request->nrc_township.'('.$request->nrc_type.')'.$request->nrc_number;
	 	$address = $request->no.'-'.$request->street.'-'.$request->township;
	 	$users = DB::table('customers')->where('id',$id)->update([
	 		'name'=>$request->name,
			'address'=>$address,
			'email'=>$request->email,
			'position'=>$request->position,
			'nrc'=>$nrc,
			'join_date'=>$request->join_date
	 	]);
	 	return redirect('/home');

	 }

	 public function download(Request $request)
	 {
	 	//echo "download";
	 	$users = DB::table('customers')
		  		->select('id','name','email','nrc','address','position','join_date')
		  		->where('name','=',$request->get('search'))->get();

	 	return Excel::download(new CustomerList,'Customer_List_Report.xlsx');
	 }
	 public function search(Request $request)
	 {
	 	//echo "search";
	 	$search = $request->get('search');
        $users = DB::table('customers')->where('name','LIKE','%'. $request->get('search') .'%')
         						->orWhere('address','LIKE','%'. $request->get('search') .'%')
                           		->orWhere('email','LIKE','%'. $request->get('search') .'%')
                           		->orWhere('nrc','LIKE','%'. $request->get('search') .'%')
                           		->orWhere('position','LIKE','%'. $request->get('search') .'%')->paginate(5);
         //dd($users);
         return view('admin.home',compact('users','search'));
	 }
	 public function need_to_approve()
	 {
	 	$null = Null;
	 	$role = [''=>''] + UserRole::orderby('name')->pluck('name', 'name')->toArray();
	 	$users = DB::table('users')
	 			->where('users.role',$null)
	 			->select('users.*')
	 			->paginate(5);
	 	return view('admin.approve',compact('users','role'));
	 			//dd($role);
	 }
	public function approved(Request $request,$id)
	{
		//echo "win p ";
		$users = DB::table('users')->where('id',$id)->update([
			'role'=>$request->role_approve
		]);

		$null = Null;
	 	$role = [''=>''] + UserRole::orderby('name')->pluck('name', 'name')->toArray();
	 	$users = DB::table('users')
	 			->where('users.role',$null)
	 			->select('users.*')
	 			->paginate(5);
	 	return view('admin.approve',compact('users','role'));
		//dd($request);
	}
	public function customer_destroy($id)
	{
		//dd($id);
		$users = DB::table('customers')->where('id',$id)->delete();
		return redirect('/home');
	}
	public function reject_approve($id)
	{
		$users = DB::table('users')->where('id',$id)->delete();
		$null = Null;
	 	$role = [''=>''] + UserRole::orderby('name')->pluck('name', 'name')->toArray();
	 	$users = DB::table('users')
	 			->where('users.role',$null)
	 			->select('users.*')
	 			->paginate(5);
	 	return view('admin.approve',compact('users','role'));
	}
	public function need_to_support()
	{
		echo "ya tl";
		//return view();
	}
}