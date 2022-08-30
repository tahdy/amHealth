<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications_group extends Model
{
    //
    protected $fillable=['first_user','second_user','acted_user','status'];
    public function first_user()
    {
        return $this->belongsTo(User::class,'first_user')->select('id','image','name');
    }
    public function second_user()
    {
        return $this->belongsTo(User::class,'second_user')->select('id','image','name');
    }
}
