<?php

namespace App\Http\Controllers;

use App\Models\entrega;
use App\Http\Controllers\Controller;
use App\Models\alquiler;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    public function entregaInsert(Request $data) {
        $datos = (object) $data;
        $entrega = (object) $datos->entrega;

        $objEntrega = entrega::find($entrega->identrega);

        if (!$objEntrega) {
            $objEntrega = new entrega();
        }
        $objEntrega->identrega = $entrega->identrega;
        $objEntrega->idalquiler = $entrega->idalquiler;
        $objEntrega->fechahora = $entrega->fechahora;
        $objEntrega->persona_recibe = $entrega->persona_recibe;
        $objEntrega->cedula_persona = $entrega->cedula_persona;
        $objEntrega->kilometraje = $entrega->kilometraje;
        $objEntrega->nota = $entrega->nota;

        $idAlquilerIn = $entrega->idalquiler;
        alquiler::where('idalquiler', $idAlquilerIn)->update(['entregado' => 1]);
        $resultado = $objEntrega->save();
        return response()->json($resultado);
    }


}
