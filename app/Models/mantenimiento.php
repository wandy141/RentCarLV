<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mantenimiento extends Model
{
    protected $table = 'mantenimiento';
    protected $primaryKey = 'idmantenimiento';
    public $timestamps = false;
    use HasFactory;
}
