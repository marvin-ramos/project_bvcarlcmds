<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use Carbon\Carbon;

class StaffController extends Controller
{	
	//for administration change password
	public function staff_change() {
		$user = auth()->user();
	    $user->employee;

		return view('change_password', compact('user'));
	}

	//for change password
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
	           ->route('staff.change')
	           ->with('success', 'Current Password Does not Matched');
	    }
	}

	//for user activities
	public function staff_activities() {
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

	//for profile area only
	public function staff_profile() {
		$user = auth()->user();
    	$user->employee;
    	
		return view('profile', compact('user'));
	}

	//for logout area
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
