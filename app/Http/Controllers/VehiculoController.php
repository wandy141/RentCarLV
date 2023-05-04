<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function _invoke()
    {
        return view('index');
    }

     public function storeVehiculo(Request $datosRec){

        $data = (object) $datosRec;
        $datos = (object) $data->vehiculo;

        $obgId = vehiculo::find($datos->idvehiculo);



        // if ($data->hasFile('imagen')) {
        //     $imagen = $data->file('imagen');
    
        //     $nombreImagen = uniqid() . '.' . $imagen->getClientOriginalExtension();
    
        //     $imagen->move(public_path('images'), $nombreImagen);
        // }
    
        if ($obgId == null){
            $obgId = new vehiculo();
            $obgId->idvehiculo = $datos->idvehiculo;
            $obgId->marca = $datos->marca;
            $obgId->modelo = $datos->modelo;
            $obgId->color = $datos->color;
            $obgId->asiento = $datos->asiento;
            $obgId->combustible = $datos->combustible;
            $obgId->tipo = $datos->tipo;
            $obgId->ano = $datos->ano;
            $obgId->placa = $datos->placa;
            $obgId->precio = $datos->precio;
          //  $obgId->imagen = $nombreImagen->imagen;
            $obgId->estado = $datos->estado;

        } else{
            $obgId->marca = $datos->marca;
            $obgId->modelo = $datos->modelo;
            $obgId->color = $datos->color;
            $obgId->asiento = $datos->asiento;
            $obgId->combustible = $datos->combustible;
            $obgId->tipo = $datos->tipo;
            $obgId->ano = $datos->ano;
            $obgId->placa = $datos->placa;
            $obgId->precio = $datos->precio;
           // $obgId->imagen = $nombreImagen->imagen;
            $obgId->estado = $datos->estado;
        }
    
        $resultado = $obgId->save();
            return response()->json($resultado);
        }

//te muestra todos los campo de un usuario en especifico
        public function idVehiculo(Request $datoi)
        {
            $data = (object) $datoi;
            $datos =  $data->idvehiculo;

            $objId = vehiculo::find($datos);
            return response()->json($objId);
        }

//mustra todos los vehiculos
        public function mostrarVehiculo()
        {
            $objAll = vehiculo::all();
            return response()->json($objAll);
        }

//funciones para buscar todos los carros segun el tipo
     public function economico()
     {
        $carros = Vehiculo::where('tipo', 1)->get();
        return response()->json($carros);
     }
     //2

     public function compacto()
     {
        $carros = Vehiculo::where('tipo', 2)->get();
        return response()->json($carros);
     }
     //3

     public function normal()
     {
        $carros = Vehiculo::where('tipo', 3)->get();
        return response()->json($carros);
     }

     //4
     public function premium()
     {
        $carros = Vehiculo::where('tipo', 4)->get();
        return response()->json($carros);
     }
     //5
     public function lujo()
     {
        $carros = Vehiculo::where('tipo', 5)->get();
        return response()->json($carros);
     }

     //6
     public function camion()
     {
        $carros = Vehiculo::where('tipo', 6)->get();
        return response()->json($carros);
     }
     

}




