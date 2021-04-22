<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'gender_id',
        'age',
        'birthday',
        'contact_number',
        'status_id',
        'address',
        'profile',
    ];
}
