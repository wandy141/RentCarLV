<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alquiler extends Model
{
    use HasFactory;
    protected $table = 'alquiler';
    protected $primaryKey = 'idalquiler';
    public $timestamps = false;
}
