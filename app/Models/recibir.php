<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recibir extends Model
{
    use HasFactory;
    protected $table = 'recibir';
    protected $primaryKey = 'idrecibir';
    public $timestamps = false;
}
