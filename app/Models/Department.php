<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','image', 'headline', 'paragraph', 'headline_ar', 'paragraph_ar', 'name', 'name_ar'];
    public $table='departments';
}
