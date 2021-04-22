<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use Carbon\Carbon;
use Session;

class LoginController extends Controller
{
    //
    public function index() {
    	return view('login');
    }

    public function login_action(Request $request) {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

    	$credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $remark = 'has Logged In to the system at';
            $id = auth()->user()->id;

            $records = History::create([
                'user_id' => $id,
                'remarks' => $remark,
                'created_at' => Carbon::now()
            ]);

            if (auth()->user()->role_name === 'Administrator') {
                Session::flash('alertTitle', 'Access Granted');
                Session::flash('alertIcon', 'success');

                return redirect()
                   ->route('main.dashboard')
                   ->with('success', 'Welcome Administrator');
            }else{
                Session::flash('alertTitle', 'Access Granted');
                Session::flash('alertIcon', 'success');

                return redirect()
                   ->route('main.dashboard')
                   ->with('success', 'Welcome Staff');
            }
        }

        Session::flash('alertTitle', 'Access Denied');
        Session::flash('alertIcon', 'warning');

        return back()
              ->with('success', 'credentials does not match');
    }
}