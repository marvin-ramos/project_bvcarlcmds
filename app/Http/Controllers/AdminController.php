<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//for model only
use App\Models\History;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\Status;
use App\Models\Role;
use App\Models\User;

use Carbon\Carbon;
use Session;
use File;
use Hash;

class AdminController extends Controller
{	
	//for administration change password
	public function admin_change() {
		$user = auth()->user();
	    $user->employee;

		return view('change_password', compact('user'));
	}

	//functionality for change password
	public function change_password(Request $request) {
		$request->validate([
	      'current_password' => 'required|min:5|max:20',
	      'new_password' => 'required|min:5|max:20|alpha_dash',
	      'new_confirm_password' => 'same:new_password',
	    ]);

	    $current_user = auth()->user();

	    if(Hash::check($request->current_password, $current_user->password)) {

	      $current_user->update([
	        'password' => Hash::make($request->new_password)
	      ]);

	      $remark = 'has updated its password in the system at';
	      $id = auth()->user()->id;

	      $records = History::create([
	          'user_id' => $id,
	          'remarks' => $remark,
	          'created_at' => Carbon::now()
	      ]);

	      Session::flash('alertTitle', 'Success');
	      Session::flash('alertIcon', 'success');

	      return redirect()
	           ->route('main.dashboard')
	           ->with('success', 'Password Successfully Updated');
	    }else{

	      Session::flash('alertTitle', 'Alert');
	      Session::flash('alertIcon', 'warning');

	      return redirect()
	           ->route('admin.change')
	           ->with('success', 'Current Password Does not Matched');
	    }
	}

	//for staff acitivities
	public function admin_activities() {
	    $user = auth()->user();
	    $user->employee;

	    $user_id = auth()->user()->id;

	    $userActivities = History::join('users', 'users.id', '=', 'histories.user_id')
                  		->join('employees', 'employees.id', '=', 'users.employee_id')
                  		->select('employees.firstname','employees.middlename','employees.lastname','employees.profile','histories.remarks','histories.created_at')
	                    ->where('user_id', '=', $user_id)
	                    ->orderBy('user_id', 'asc')
	                   ->simplePaginate(15); 

	    return view('activities', compact('userActivities','user'))
	         ->with('i', (request()->input('page', 1) - 1) * 15);
	}

	//for admin profile here
	public function admin_profile() {
		$user = auth()->user();
    	$user->employee;

		return view('profile', compact('user'));
	}
	//for history table
	public function history_table() {
		$user = auth()->user();
    	$user->employee;

		$historyData = History::join('users', 'users.id', '=', 'histories.user_id')
                  ->join('employees', 'employees.id', '=', 'users.employee_id')
                  ->select('employees.firstname','employees.middlename','employees.lastname','employees.profile','histories.remarks','histories.created_at')
                  ->get();

    	return view('history', compact('historyData','user'))
    		 ->with('i', (request()->input('page', 1) - 1) * 15);
	}

	//for account employee area
	public function account_table() {
		$accountData = User::join('employees', 'employees.id', '=', 'users.employee_id')
                  ->join('genders', 'genders.id', '=', 'employees.gender_id')
                  ->join('statuses', 'statuses.id', '=', 'employees.status_id')
                  ->select('users.id','employees.firstname','employees.middlename','employees.lastname','genders.gender','employees.age','employees.birthday','employees.contact_number','statuses.status','employees.address','employees.profile', 'users.email', 'users.password','users.role_name')
                  ->get();
    	return view('account.table_account', compact('accountData'))
    		 ->with('i', (request()->input('page', 1) - 1) * 15);
	}
	public function account_add($id) {
		$roleData = Role::select('id','display_name')->get();
		$genderData = Gender::select('id','gender')->get();
	    $statusData = Status::select('id','status')->get();
	    $employeeData = Employee::find($id)
               ->join('genders', 'genders.id', '=', 'employees.gender_id')
               ->join('statuses', 'statuses.id', '=', 'employees.status_id')
               ->select('employees.id','employees.firstname','employees.middlename','employees.lastname','genders.gender','employees.gender_id','employees.age','employees.birthday','employees.contact_number','statuses.status','employees.status_id','employees.address','employees.profile')
               ->where('employees.id', '=', $id)
               ->first();
	    return view('account.add_account', compact('genderData','statusData','employeeData','roleData'));
	}
	public function account_store(Request $request) {
		$request->validate([      
	        'employee_id'           => 'required',
	        'role'					=> 'required',
	        'email'                 => 'required|string|email|max:255|unique:users',
	        'password'              => 'required|string|min:8|confirmed',
	        'password_confirmation' => 'required',
	    ]);

	    $employee_account = User::where([
            ['employee_id', '=', $request->get('employee_id')], 
            ])->first();

	    if ($employee_account == null ) {

	    	$role_name = 'Staff';

			$user =  User::create([
		        'employee_id' => $request['employee_id'],
		        'email' 	  => $request['email'],
		        'password' 	  => Hash::make($request['password']),
		        'role_name'   => $role_name,
		    ]);

		    $role = new App\Role(['role' => 2]);
			$user->roles()->save($role);
			return $user;

			$email = $request->email; 
			$userid = auth()->user()->id;
			$remark = 'has created '. $email .' account to the system';

			$records = History::create([
				'user_id' => $userid,
				'remarks' => $remark,
				'created_at' => Carbon::now()
			]);

			Session::flash('alertTitle', 'Success');
			Session::flash('alertIcon', 'success');

			return redirect()
				 ->route('table.account')
				 ->with('success', 'Account has created Successfully');

	    } else {
			Session::flash('alertTitle', 'Opps');
			Session::flash('alertIcon', 'warning');

			return back()
			     ->with('success', 'Employee has Already have an account');
	    }
	}
	public function account_view($id) {
	    $employeeData = User::find($id)
               ->join('employees', 'employees.id', '=', 'users.employee_id')
               ->join('genders', 'genders.id', '=', 'employees.gender_id')
               ->join('statuses', 'statuses.id', '=', 'employees.status_id')
               ->select('employees.firstname','employees.middlename','employees.lastname','genders.gender','employees.gender_id','employees.age','employees.birthday','employees.contact_number','statuses.status','employees.status_id','employees.address','employees.profile', 'users.email','users.role_name')
               ->first();
	    return view('account.view_account', compact('employeeData'));
	}

	//for employee area
	public function employee_table() {
		$employees = Employee::latest()->paginate(15);

        return view('employee.table', compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 15);
	}
	public function employee_add() {
		$genderData = Gender::select('id','gender')->get();
	    $statusData = Status::select('id','status')->get();
	    return view('employee.add', compact('genderData','statusData'));
	}
	public function employee_store(Request $request) {

		$request->validate([
	        'firstname'         => 'required|min:3|max:20|alpha',
	        'middlename'        => 'required|alpha',
	        'lastname'          => 'required|min:3|max:20|alpha',
	        'gender_id'         => 'required',
	        'birthday'          => 'required',
	        'contact_number'    => 'required|numeric', 
	        'status_id'         => 'required',
	        'address'           => 'required',
	        'profile'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	    ]);

	    $employee = Employee::where([
            ['firstname', '=', $request->get('firstname')],
            ['middlename', '=', $request->get('middlename')],
            ['lastname', '=', $request->get('lastname')],
        ])->first();

	    if ($employee == null) {

	      $data = array();
	      $data['firstname']      = $request->firstname;
	      $data['middlename']     = $request->middlename;
	      $data['lastname']       = $request->lastname;
	      $data['gender_id']      = $request->gender_id;
	      $data['age']            = $request->age;
	      $data['birthday']       = $request->birthday;
	      $data['contact_number'] = $request->contact_number;
	      $data['status_id']      = $request->status_id;
	      $data['address']        = $request->address;

	      $image = $request->file('profile');
	      if($image) {
	        $image_name = date('dmy_H_s_i');
	        $text = strtolower($image->getClientOriginalExtension());
	        $image_full_name = $image_name. '.' .$text;
	        $upload_path = 'images/employee/';
	        $image_url = $upload_path.$image_full_name;
	        $success = $image->move($upload_path,$image_full_name);
	        $data['profile'] = $image_url;
	      }
	      
	      $employeeRecords = Employee::insert($data);

	      $firstname = $request->firstname; 
	      $middlename = $request->middlename; 
	      $lastname = $request->lastname;
	      
	      $id = auth()->user()->id;
	      $remark = 'has added '. $firstname .' '. $middlename .' '. $lastname.' to the system';

	      $records = History::create([
	          'user_id' => $id,
	          'remarks' => $remark,
	          'created_at' => Carbon::now()
	      ]);

	      Session::flash('alertTitle', 'Success');
	      Session::flash('alertIcon', 'success');

	      return Redirect()
	             ->route('employee.table')
	             ->with('success','Greate! Employee created successfully.');
	    } else {

	      Session::flash('alertTitle', 'Alert');
	      Session::flash('alertIcon', 'error');

	      return Redirect()
	             ->route('employee.add')
	             ->with('success', 'Opps Employee Already Exist');
	    }
	}
	public function employee_edit($id) {
		$genderData = Gender::select('id','gender')->get();
	    $statusData = Status::select('id','status')->get();
	    $employeeData = Employee::find($id)
               ->join('genders', 'genders.id', '=', 'employees.gender_id')
               ->join('statuses', 'statuses.id', '=', 'employees.status_id')
               ->select('employees.id','employees.firstname','employees.middlename','employees.lastname','genders.gender','employees.gender_id','employees.age','employees.birthday','employees.contact_number','statuses.status','employees.status_id','employees.address','employees.profile')
               ->where('employees.id', '=', $id)
               ->first();
	    return view('employee.update', compact('genderData','statusData','employeeData'));
	}
	public function employee_update(Request $request, $id) {
		$data = array();
	    $data['firstname']      = $request->firstname;
	    $data['middlename']     = $request->middlename;
	    $data['lastname']       = $request->lastname;
	    $data['gender_id']      = $request->gender_id;
	    $data['age']            = $request->age;
	    $data['birthday']       = $request->birthday;
	    $data['contact_number'] = $request->contact_number;
	    $data['status_id']      = $request->status_id;
	    $data['address']        = $request->address;

	    $old_picture = $request->old_profile;

	    if($request->hasFile('profile')) {
	        $destinationpath = 'images/employee/';
	        $image = $request->file('profile');
	        $image_name = date('dmy_H_s_i');
	        $text = strtolower($image->getClientOriginalExtension());
	        $image_full_name = $image_name. '.' .$text;
	        $upload_path = 'images/employee/';
	        $image_url = $upload_path.$image_full_name;
	        $success = $image->move($upload_path,$image_full_name);
	        $data['profile'] = $image_url;
	    }

	    $employeeRecords = Employee::where('id', $id)
	                      ->update($data);

	    $firstname = $request->firstname; 
	    $middlename = $request->middlename; 
	    $lastname = $request->lastname;
	    
	    $id = auth()->user()->id;
	    $remark = 'has updated '. $firstname .' '. $middlename .' '. $lastname.' to the system';

	    $records = History::create([
	        'user_id' => $id,
	        'remarks' => $remark,
	        'created_at' => Carbon::now()
	    ]);

	    Session::flash('alertTitle', 'Success');
	    Session::flash('alertIcon', 'success');

	    return Redirect()
	           ->route('employee.table')
	           ->with('success','Greate! Employee updated successfully.');
	}
	public function employee_view($id) {
		$genderData = Gender::select('id','gender')->get();
	    $statusData = Status::select('id','status')->get();
	    $employeeData = Employee::find($id)
               ->join('genders', 'genders.id', '=', 'employees.gender_id')
               ->join('statuses', 'statuses.id', '=', 'employees.status_id')
               ->select('employees.id','employees.firstname','employees.middlename','employees.lastname','genders.gender','employees.gender_id','employees.age','employees.birthday','employees.contact_number','statuses.status','employees.status_id','employees.address','employees.profile')
               ->where('employees.id', '=', $id)
               ->first();
	    return view('employee.view', compact('genderData','statusData','employeeData'));
	}
	public function employee_delete($id) {
		$remark = 'has deleted an account in the system at';
	    $user_id = auth()->user()->id;

	    $records = History::create([
	        'user_id' => $user_id,
	        'remarks' => $remark,
	        'created_at' => Carbon::now()
	    ]);

	    $data = Employee::find($id)
	            ->where('id', $id)
	            ->firstorfail();
	    
	    $image = $data->profile;
	    
	    File::delete($image);

	    $deleteRecords = Employee::where('id', $id)->delete();

	    Session::flash('alertTitle', 'Success');
	    Session::flash('alertIcon', 'success');

	    return Redirect()
	        ->route('employee.table')
	        ->with('success','Greate! Employee deleted successfully.');
	}
	public function logout(Request $request) {
		$remark = 'has Logged In to the system at';
		$id = auth()->user()->id;

		$records = History::create([
		    'user_id' => $id,
		    'remarks' => $remark,
		    'created_at' => Carbon::now()
		]);
            
    	Auth::logout();
	    $request->session()->invalidate();
	    $request->session()->regenerateToken();
	    return redirect('/login-page');
    }
}