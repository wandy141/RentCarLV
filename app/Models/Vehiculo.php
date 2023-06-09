<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $table = 'vehiculo';
    protected $primaryKey = 'idvehiculo';
    public $timestamps = false;

    public function alquileres()
    {
        return $this->hasMany(alquiler::class);
    }
}

?>
