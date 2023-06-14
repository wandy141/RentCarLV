<?php

namespace App\Http\Controllers;

use App\Models\mantenimiento;
use App\Models\Vehiculo as ModelsVehiculo;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    function todoMantenimiento()
    {
        $todomantenimiento = mantenimiento::where('estado', 1)->get();
        return response()->json($todomantenimiento);
    }

    function insertarMantenimiento(Request $request)
    {
        $datos = (object) $request;
        $mantenimiento = (object) $datos->mantenimiento;

        $objMantenimiento = mantenimiento::find($mantenimiento->idmantenimiento);

        if (!$objMantenimiento) {
            $objMantenimiento = new mantenimiento();
        }
        $objMantenimiento->idmantenimiento = $mantenimiento->idmantenimiento;
        $objMantenimiento->id_recibir = $mantenimiento->id_recibir;
        $objMantenimiento->id_vehiculo = $mantenimiento->id_vehiculo;
        $objMantenimiento->costo_extra = $mantenimiento->costo_extra;
        $objMantenimiento->comentario = $mantenimiento->comentario;

        // $idAlquilerIn = $recibir->idalquiler;
        // alquiler::where('idalquiler', $idAlquilerIn)->update(['entregado' => 1]);
        $resultado = $objMantenimiento->save();
        return response()->json($resultado);
    }
}
