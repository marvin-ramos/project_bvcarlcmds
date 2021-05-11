<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    use HasFactory;
    protected $fillable = [
    	'gate_in',
    	'gate_out',
    	'created_at',
    ];
}
