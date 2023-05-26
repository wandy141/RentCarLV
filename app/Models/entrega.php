<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entrega extends Model
{
    use HasFactory;
    protected $table = 'entrega';
    protected $primaryKey = 'identrega';
    public $timestamps = false;
}
