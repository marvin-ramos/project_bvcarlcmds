<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gate;
use App\Models\Chart;
use Carbon\Carbon;  
use DB;

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
        return view('dashboard');
    }

    public function dashboard() {
        $user = auth()->user();
        $user->employee;

        //for gate data
        $gate_in = Gate::where('gate_in','=','1')
                 ->whereDate('created_at', Carbon::today())
                 ->count();

        $gate_out = Gate::where('gate_out','=','1')
                  ->whereDate('created_at', Carbon::today())
                  ->count();

        $remain_people = $gate_in - $gate_out;
        
        $data = Gate::select([
            \DB::raw('count(*) as visitor'),
            \DB::raw('DATE(created_at) as date')
        ])
        ->where('gate_in','=','1')
        ->groupBy('date')
        ->pluck('visitor')
        ->all();

        $label = Gate::select([
            \DB::raw('count(*) as visitor'),
            \DB::raw('DATE(created_at) as date')
        ])
        ->groupBy('date')
        ->pluck('visitor', 'date')
        ->toArray();
        
        // Prepare the data for returning with the view
        $chart = new Chart;
        $chart->labels = (array_keys($label));
        $chart->dataset = (array_values($data));

        return view('dashboard', compact('user', 'chart', 'data', 'label'))
             ->with('gate_in', $gate_in)
             ->with('gate_out', $gate_out)
             ->with('remain_people', $remain_people);
    }

    public function card() {
                $user = auth()->user();
        $user->employee;

        //for gate data
        $gate_in = Gate::where('gate_in','=','1')
                 ->whereDate('created_at', Carbon::today())
                 ->count();

        $gate_out = Gate::where('gate_out','=','1')
                  ->whereDate('created_at', Carbon::today())
                  ->count();

        $remain_people = $gate_in - $gate_out;
        
        $data = Gate::select([
            \DB::raw('count(*) as visitor'),
            \DB::raw('DATE(created_at) as date')
        ])
        ->where('gate_in','=','1')
        ->groupBy('date')
        ->pluck('visitor')
        ->all();

        $label = Gate::select([
            \DB::raw('count(*) as visitor'),
            \DB::raw('DATE(created_at) as date')
        ])
        ->groupBy('date')
        ->pluck('visitor', 'date')
        ->toArray();
        
        // Prepare the data for returning with the view
        $chart = new Chart;
        $chart->labels = (array_keys($label));
        $chart->dataset = (array_values($data));

        return view('layouts/card', compact('user', 'chart', 'data', 'label'))
             ->with('gate_in', $gate_in)
             ->with('gate_out', $gate_out)
             ->with('remain_people', $remain_people);
    }
}
