<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table='portfolios';

    protected $fillable=['userId','portfolioName','portfolioDesc','portfolioUrl'];

    public function user(){
        return $this->belongsTo(User::class,'userId');
    }
}
