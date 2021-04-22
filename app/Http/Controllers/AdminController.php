<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//for model only
use App\Models\History;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\Status;

use Carbon\Carbon;

class AdminController extends Controller
{

	public function employee_table() {
		return view('employee.table');
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
	        'profile'           => 'required',
	    ]);
		dd($request);
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

	      $records = Log::create([
	          'user_id' => $id,
	          'remarks' => $remark,
	          'created_at' => Carbon::now()
	      ]);

	      Session::flash('alertTitle', 'Success');
	      Session::flash('alertIcon', 'success');

	      return Redirect()
	             ->route('table.employee')
	             ->with('success','Greate! Employee created successfully.');
	    } else {

	      Session::flash('alertTitle', 'Alert');
	      Session::flash('alertIcon', 'error');

	      return Redirect()
	             ->route('employee.add')
	             ->with('success', 'Opps Employee Already Exist');
	    }
	}

		public function employee_edit() {
			return view('employee.update');
		}

		public function employee_view() {
			return view('employee.view');
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
