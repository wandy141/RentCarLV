<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\alquiler as ModelsAlquiler;
use Illuminate\Http\Request;

class alquiler extends Controller
{
    public function alquiler(Request $data) {
        $datos = (object) $data;
        $alquiler = (object) $datos->alquiler;
    
        $objAlquiler = ModelsAlquiler::find($alquiler->idalquiler);
    
        if (!$objAlquiler) {
            $objAlquiler = new ModelsAlquiler();
        }
    
        $objAlquiler->idalquiler = $alquiler->idalquiler;
        $objAlquiler->usuario = $alquiler->usuario;
        $objAlquiler->fecha = $alquiler->fecha;
        $objAlquiler->idvehiculo = $alquiler->idvehiculo;
        $objAlquiler->precio = $alquiler->precio;
        $objAlquiler->dias = $alquiler->dias;
        $objAlquiler->fechaini = $alquiler->fechaini;
        $objAlquiler->fechafin = $alquiler->fechafin;
        $objAlquiler->total = $alquiler->total;

    
        $resultado = $objAlquiler->save();
        return response()->json($resultado);
    }


public function todoAlquiler()
{
    $consulta = ModelsAlquiler::all();
    return response()->json($consulta);
    }

    
}


