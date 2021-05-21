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
        
        $dailyData = Gate::selectRaw("COUNT(*) visitor, DATE_FORMAT(created_at, '%Y %m %e') date")
                   ->groupBy('date')
                   ->pluck('visitor', 'date')->all();

        for ($i=0; $i<=count($dailyData); $i++) {
                    $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
                }
        // Prepare the data for returning with the view
        $chart = new Chart;
                $chart->labels = (array_keys($dailyData));
                $chart->dataset = (array_values($dailyData));
                $chart->colours = $colours;

        // $chart1 = new Chart;
        // $chart1->dataset = (array_values($dailyData));

        return view('dashboard', compact('user','chart'))
             ->with('gate_in', $gate_in)
             ->with('gate_out', $gate_out)
             ->with('remain_people', $remain_people);
    }
}
