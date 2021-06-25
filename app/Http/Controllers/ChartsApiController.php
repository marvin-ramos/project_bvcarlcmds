<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gate;
use Carbon\Carbon;

class ChartsApiController extends Controller
{
    public function index()
    {
        
        $gatein = Gate::latest()->take(30)->get()->sortBy('id');
        $labels = $gatein->pluck('id');
        $data1 = $gatein->pluck('gate_in');
        $data2 = $gatein->pluck('gate_out');

        return response()->json(compact('labels', 'data1', 'data2'));
    }
}
