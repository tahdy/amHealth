<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = ['id','info', 'prescription','blood_pressure',
        'heart_rate', 'glucose_level','blood_pressure','visit_date', 'blood_count','Diseases','doctor_id','patient_id'];
    public $table='visits';
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }
}
