<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    public $table='patients';
    protected $fillable = [
        'id','info', 'Last Visit', 'is_insurance','insurance_responsible', 'user_id','insurance_id','occupation'
    ,'blood_group'];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function visits()
    {
        return $this->hasMany('App\Models\Visit');
    }

}
