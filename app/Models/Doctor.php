<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    public $table='doctors';
    protected $fillable = [
        'id','bio', 'specialty', 'user_id','department_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
}
