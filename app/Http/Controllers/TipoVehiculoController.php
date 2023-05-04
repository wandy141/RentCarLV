<?php

namespace App\Http\Controllers;

use App\Models\tipoVehiculo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipoVehiculoController extends Controller
{
    public function _invoke()
    {
        return view('index');
    }

   
 public function tipoVehiculo(Request $datae)
{
    $data = (object)$datae;
    $tipo = (object)$data->tipovehiculo;

    // $consulta = tipoVehiculo::where('tipo', $tipoLv)->where('estado', $estadoLv)->get();

    $objId = tipoVehiculo::find($tipo->idtipo); 
    
    

    if ($objId == null){
        $objId = new tipoVehiculo();
        $objId->idtipo = $tipo->idtipo;
        $objId->tipo = $tipo->tipo;
        $objId->estado = $tipo->estado;
    
    } else{
        $objId->tipo = $tipo->tipo;
        $objId->estado = $tipo->estado;
    }

    $resultado = $objId->save();
    return response()->json($resultado);
}


public function tipoid(Request $datai)
{
    $data=(object) $datai;
    $tipo = $data->idtipo;

   $consulta = tipoVehiculo::find($tipo);

 
    return response()->json($consulta);
}


public function todoTipo()
{
   $tipo= tipoVehiculo::all();
   return response()->json($tipo);
   
}

}
