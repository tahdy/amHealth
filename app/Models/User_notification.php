<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_notification extends Model
{
    //
    protected $fillable = ['message','url', 'from_user_id','to_user_id', 'notifications_group_id'];

    public function from_user()
    {
        return $this->belongsTo(User::class,'from_user_id')->select('id','image','name');
    }
    public function to_user()
    {
        return $this->belongsTo(User::class,'to_user_id')->select('id','image','name');
    }
    public function hasUser($user_id)
    {
        if ($this->from_user == $user_id){
            return true;
        }
    }
}
