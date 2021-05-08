<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use Carbon\Carbon;

class StaffController extends Controller
{	
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
