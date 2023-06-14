<?php

namespace App\Http\Controllers;

use App\Models\recibir;
use App\Http\Controllers\Controller;
use App\Models\alquiler;
use App\Models\entrega;
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

        // $idAlquilerIn = $recibir->idalquiler;
        // alquiler::where('idalquiler', $idAlquilerIn)->update(['entregado' => 1]);
        $resultado = $objRecibir->save();
        return response()->json($resultado);
    }


    function todoRecibir()
    {
        $toalquiler = entrega::where('estado', 1)->get();
        return response()->json($toalquiler);
    }
}
