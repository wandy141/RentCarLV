<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\alquiler as ModelsAlquiler;
use App\Models\Vehiculo as vehiculo;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
        $objAlquiler->idcliente = $alquiler->idcliente;
        $objAlquiler->nombrecliente = $alquiler->nombrecliente;
        $objAlquiler->fecha = $alquiler->fecha;
        $objAlquiler->idvehiculo = $alquiler->idvehiculo;
        $objAlquiler->precio = $alquiler->precio;
        $objAlquiler->dias = $alquiler->dias;
        $objAlquiler->fechaini = $alquiler->fechaini;
        $objAlquiler->fechafin = $alquiler->fechafin;
        $objAlquiler->total = $alquiler->total;
        $idVehiculo = $alquiler->idvehiculo;
        vehiculo::where('idvehiculo', $idVehiculo)->update(['estado' => 0]);
    
        $resultado = $objAlquiler->save();
        return response()->json($resultado);
    }


public function todoAlquiler()
{
    $consulta = ModelsAlquiler::all();
    return response()->json($consulta);
    }

    public function destroyAlquiler($idalquiler)
    {
        $alquiler = ModelsAlquiler::find($idalquiler);
        if (!$alquiler) {
            $resultado = false;
        } else {
        $idVehiculo = $alquiler->idvehiculo;
        vehiculo::where('idvehiculo', $idVehiculo)->update(['estado' => 1]);
         
         $resultado = $alquiler->delete();
       
        }         
        return response()->json($resultado); 
        }

        public function casiUno()
        {
             
            $fechaManana = Carbon::now();
            $alquiler = ModelsAlquiler::whereDate('fechafin', $fechaManana->toDateString())->get();
        
            return response()->json($alquiler);
        }
   
        public function casiDo()
        {
            $fechaManana = Carbon::now()->addDay();
            $alquiler = ModelsAlquiler::whereDate('fechafin', $fechaManana->toDateString())->get();
        
            return response()->json($alquiler);
        }
   

        public function casiTre()
        {
            $fechaManana = Carbon::now()->addDay(2);
            $alquiler = ModelsAlquiler::whereDate('fechafin', $fechaManana->toDateString())->get();
        
            return response()->json($alquiler);
        }
   
    



    
}


