<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function matching(){
        return $this->hasMany(Matching::class)->select('user_id','money','release_money','zyl_num');
    }

    public function recommend(){
        return $this->belongsTo(User::class, 'recommend_id', 'id');
    }
    //获取接点上一级
    public function node_user(){
        return $this->hasOne(Node::class)->with('top_username')->where('level',1);
    }
    //获取静态收益  定时任务
    public function static_money(){
        return $this->hasMany(Matching::class)->where('state',0)->select('user_id','money');
    }

    public function dynamic_user(){
        return $this->hasMany(Node::class,'top_id')->with('dynamic_matching')->select('user_id','top_id','type');
    }

}
