<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Gender;
use App\Models\Status;

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

    public function gender() {
        return $this->hasOne(Gender::class, 'id','gender_id');
    }

    public function status() {
        return $this->hasOne(Status::class, 'id','status_id');
    }
}
