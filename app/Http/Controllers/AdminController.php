<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//for model only
use App\Models\History;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\Status;

use Carbon\Carbon;
use Session;
use File;

class AdminController extends Controller
{
	//for account employee area
	public function account_add($id) {
		$genderData = Gender::select('id','gender')->get();
	    $statusData = Status::select('id','status')->get();
	    $employeeData = Employee::find($id)
               ->join('genders', 'genders.id', '=', 'employees.gender_id')
               ->join('statuses', 'statuses.id', '=', 'employees.status_id')
               ->select('employees.id','employees.firstname','employees.middlename','employees.lastname','genders.gender','employees.gender_id','employees.age','employees.birthday','employees.contact_number','statuses.status','employees.status_id','employees.address','employees.profile')
               ->where('employees.id', '=', $id)
               ->first();
	    return view('account.add_account', compact('genderData','statusData','employeeData'));
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