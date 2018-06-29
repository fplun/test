<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class);
    }
}
