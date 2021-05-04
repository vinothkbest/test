<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Employee extends Model
{
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'dob',
        'salary',
        'address',
        'is_admin',
        'password',

    ];

    protected $hidden = [
        'password',
        'updated_at',
        'created_at'
    ];
    protected $appends = ['role'];

    public function getDobAttribute($dob){
        return Carbon::parse($dob)->format("d-m-Y");
    }

    public function getRoleAttribute(){
        return ($this->is_admin)?"Admin":"Employee";
    }
}
