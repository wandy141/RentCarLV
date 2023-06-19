<?php

namespace App\Http\Controllers;

use App\Models\recibir;
use App\Http\Controllers\Controller;
use App\Models\alquiler;
use App\Models\entrega;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class RecibirController extends Controller
{
    public function RecibirInsert(Request $data)
    {
        $datos = (object) $data;
        $recibir = (object) $datos->recibir;

        $objRecibir = recibir::find($recibir->idrecibir);

        if (!$objRecibir) {
            $objRecibir = new recibir();
        }
        $objRecibir->idrecibir = $recibir->idrecibir;
        $objRecibir->id_cliente = $recibir->id_cliente;
        $objRecibir->id_alquiler = $recibir->id_alquiler;
        $objRecibir->NombreCli = $recibir->NombreCli;
        $objRecibir->FechHoraDev = $recibir->FechHoraDev;
        $objRecibir->Comentarios = $recibir->Comentarios;

        $idAlquilerIn = $recibir->id_alquiler;
        $alquiler = Alquiler::where('idalquiler', $idAlquilerIn)->first();
        
        if ($alquiler) {
            $idCarro = $alquiler->idcarro;
            Vehiculo::where('idcarro', $idCarro)->update(['estado' => 2]);
        }
        
        $alquiler->update(['estado' => 2, 'recibido' => 1]);
        
        $alquiler = alquiler::find($idAlquilerIn);
    
    if ($alquiler) {
        $idVehiculo = $alquiler->idvehiculo;
        $vehiculo = Vehiculo::find($idVehiculo);
        
        if ($vehiculo) {
            $vehiculo->estado = 2;
            $vehiculo->save();
        }
    }
       
        $resultado = $objRecibir->save();
        return response()->json($resultado);
    }



    function todoRecibir()
    {
        $toalquiler = entrega::where('estado', 1)->get();
        return response()->json($toalquiler);
    }
}
