<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LoanApplication extends Model
{
    use HasFactory;

    protected $fillable = [ 'firstname', 'lastname', 'gender', 'homeAddress', 'phoneNumber', 'email', 'occupation',
        'monthlySalary','maritalStatus','BVN','loanStatus','refereeName', 'refereePhonenumber',
    ];


    public function user(){

        return $this->belongsTo(User::class);
    }
}
