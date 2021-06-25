<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gate;
use Carbon\Carbon;
use DB;

class BarChartsApiController extends Controller
{
    public function index() {
        $data1 = Gate::select([
            \DB::raw('count(*) as visitor'),
            \DB::raw('DATE(created_at) as date')
        ])
        ->where('gate_in','=','1')
        ->groupBy('date')
        ->pluck('visitor')
        ->all();

        $labels = Gate::select([
            \DB::raw('count(*) as visitor'),
            \DB::raw('DATE(created_at) as date')
        ])
        ->groupBy('date')
        ->pluck('visitor', 'date')
        ->toArray();
        
        return response()->json(compact('labels', 'data1'));
    }
}
