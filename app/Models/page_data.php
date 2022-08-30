<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class page_data extends Model
{
    use HasFactory;
    protected $fillable = ['id','section', 'headline', 'paragraph'];
    public $table='page_datas';
}
