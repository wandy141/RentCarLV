<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registrarse extends Model
{
    use HasFactory;
    protected $table = 'registro';
    protected $primaryKey = 'idcliente';
    protected $keyType = 'string';
    public $timestamps = false;
}
