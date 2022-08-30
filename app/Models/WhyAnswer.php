<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['id','icon', 'headline', 'paragraph'];
    public $table='why_answers';
}
