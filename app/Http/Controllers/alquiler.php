<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\alquiler as ModelsAlquiler;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class alquiler extends Controller
{
    public function alquiler(Request $data)
    {
        $datos = (object) $data;
        $alquiler = (object) $datos->alquiler;
        $objAlquiler = ModelsAlquiler::find($alquiler->idalquiler);

        $condicion = ModelsAlquiler::where('idvehiculo', $alquiler->idvehiculo)
            ->where('estado', 1)
            ->where(function ($query) use ($alquiler) {
                $query->whereBetween('fechaini', [$alquiler->fechaini, $alquiler->fechafin])
                    ->orWhereBetween('fechafin', [$alquiler->fechaini, $alquiler->fechafin]);
            })
            ->count();

        if ($condicion > 0) {
            return response()->json(false);
        }


        if (!$objAlquiler) {
            $objAlquiler = new ModelsAlquiler();
        }

        $objAlquiler->idalquiler = $alquiler->idalquiler;
        $objAlquiler->usuario = $alquiler->usuario;
        $objAlquiler->idcliente = $alquiler->idcliente;
        $objAlquiler->nombrecliente = $alquiler->nombrecliente;
        $objAlquiler->fecha = $alquiler->fecha;
        $objAlquiler->idvehiculo = $alquiler->idvehiculo;
        $objAlquiler->seguro = $alquiler->seguro;
        $objAlquiler->precio = $alquiler->precio;
        $objAlquiler->dias = $alquiler->dias;
        $objAlquiler->fechaini = $alquiler->fechaini;
        $objAlquiler->fechafin = $alquiler->fechafin;
        $objAlquiler->total = $alquiler->total;
        $objAlquiler->estado = $alquiler->estado;
        $resultado = $objAlquiler->save();
        return response()->json($resultado);
    }


    public function todoAlquiler()
    {
        $consulta = ModelsAlquiler::all();
        return response()->json($consulta);
    }


    public function AlquilerActivo()
    {
        $consulta = ModelsAlquiler::where('estado',1)->where('entregado',0)->get();
        return response()->json($consulta);
    }


    public function destroyAlquiler($idalquiler)
    {
        $alquiler = ModelsAlquiler::find($idalquiler);
        if (!$alquiler) {
            $resultado = false;
        } else {
            // $idVehiculo = $alquiler->idvehiculo;
            // vehiculo::where('idvehiculo', $idVehiculo)->update(['estado' => 1]);

            $resultado = $alquiler->delete();
        }
        return response()->json($resultado);
    }


    public function vencieron()
    {
        $fechaActual = Carbon::now();
        $alquileres = [];

        for ($i = 1; $i <= 40; $i++) {
            $fechaAnterior = $fechaActual->subDay();
            $alquiler = ModelsAlquiler::whereDate('fechafin', $fechaAnterior->toDateString())->get();
            $alquileres = array_merge($alquileres, $alquiler->toArray());
        }

        return response()->json($alquileres);
    }





    public function carrosActivos()
    {
        $consulta = vehiculo::where('estado', 1)->get();
        return response()->json($consulta);
    }



    public function casiUno()
    {
        $fechaManana = Carbon::now();
        $alquiler = ModelsAlquiler::whereDate('fechafin', $fechaManana->toDateString())->where('estado',1)->get();

        return response()->json($alquiler);
    }

    public function casiDo()
    {
        $fechaManana = Carbon::now()->addDay();
        $alquiler = ModelsAlquiler::whereDate('fechafin', $fechaManana->toDateString())->where('estado',1)->get();

        return response()->json($alquiler);
    }


    public function casiTre()
    {
        $fechaManana = Carbon::now()->addDay(2);
        $alquiler = ModelsAlquiler::whereDate('fechafin', $fechaManana->toDateString())->where('estado',1)->get();

        return response()->json($alquiler);
    }

    public function bajoPrecio()
    {
        $carros = Vehiculo::where('precio', '<', 50)->where('estado', 1)->get();
        return response()->json($carros);
    }

    public function medioPrecio()
    {
        $carros = Vehiculo::where('precio', '<=', 60)->where('precio', '>=',50)->where('estado', 1)->get();
        return response()->json($carros);
    }

    public function mayorPrecio()
    {
        $carros = Vehiculo::where('precio', '>', 60)->where('estado', 1)->get();
        return response()->json($carros);
    }
}
