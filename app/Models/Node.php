<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    //

    public function top_username()
    {
        return $this->belongsTo(User::class, 'top_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dynamic_matching()
    {
        return $this->hasMany(Matching::class, 'user_id', 'user_id')->where('state', 0)->select('user_id', 'money');
    }


    public function dynamic_node(){
        return $this->hasMany(Node::class,'top_id','user_id')->with('dynamic_matching')->select('user_id','top_id','type');
    }
}
