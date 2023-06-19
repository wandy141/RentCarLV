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
        $objRecibir->id_entrega = $recibir->id_cliente;
        $objRecibir->id_alquiler = $recibir->id_alquiler;
        $objRecibir->NombreCli = $recibir->NombreCli;
        $objRecibir->FechHoraDev = $recibir->FechHoraDev;
        $objRecibir->Comentarios = $recibir->Comentarios;
        $objRecibir->idvehiculo = $recibir->idvehiculo;

        $idAlquilerIn = $recibir->id_alquiler;
        $identre = $recibir->id_cliente;
        $idvehi = $recibir->idvehiculo;
        alquiler::where('idalquiler', $idAlquilerIn)->update(['recibido' => 1, 'estado' => 2]);
        Entrega::where('identrega', $identre)->update(['estado' => 0]);
        Vehiculo::where('idvehiculo', $idvehi)->update(['estado' => 2]);

        $resultado = $objRecibir->save();
        return response()->json($resultado);
    }


    function todoRecibir()
    {
        $toalquiler = entrega::where('estado', 1)->get();
        return response()->json($toalquiler);
    }
}
