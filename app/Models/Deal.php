<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    //
    public function sell_user(){
        return $this->belongsTo(User::class,'sell_id');
    }
    public function buy_user(){
        return $this->belongsTo(User::class,'buy_id');
    }
}
