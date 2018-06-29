<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    //
    public function admin_user(){
        return $this->belongsTo(AdminUser::class,'admin_id');
    }
}
