<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table='memberships';

    protected $fillable=['membershipName','membershipPrice','membershipDesc'];

    public function membershipTransactions(){
        return $this->hasMany(MembershipTransaction::class,'membershipId');
    }
}
