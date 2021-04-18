<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function index() {
		return view('dashboard');
	}

	public function employee_table() {
		return view('employee.table');
	}

	public function employee_add() {
		return view('employee.add');
	}

	public function employee_edit() {
		return view('employee.update');
	}

	public function employee_view() {
		return view('employee.view');
	}
}
