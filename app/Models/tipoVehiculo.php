<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoVehiculo extends Model
{
    use HasFactory;
    protected $table = 'tipovehiculo';
    protected $primaryKey = 'idtipo' ;
    public $timestamps = false;
}
