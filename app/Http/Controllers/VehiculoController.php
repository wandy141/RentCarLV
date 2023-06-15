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

public function Imagen(Request $image)
{
    // return response()->json($image);
$id = $image['id'];

if ($image->hasFile('file')) {
   $file = $image->file('file');
   $filename = $file->getClientOriginalName();
   $filename = pathinfo($filename, PATHINFO_FILENAME);
   $name_File = str_replace(" ","_",$filename);
   $extension = $file->getClientOriginalExtension();
   $picture = date('His') . '-' . $name_File . '.' . $extension;
   $file->move(public_path('../../RentCarAG/src/assets/'), $picture);


   $vehiculo = Vehiculo::find($id);
   $vehiculo->imagen = $picture;
   $vehiculo->save();


return response()->json(["mesaje" => "Imagen Guardada" ]);
}else{

return response()->json(["mesaje" => "No se pudo"]);

}



}

public function storeVehiculo(Request $datosRec)
{
    // return response()->json($datosRec);

    // Guardar la imagen en la carpeta de assets
    // if ($datosRec->hasFile('file')) {
    //     $file = $datosRec->file('file');
    //     $filename = $file->getClientOriginalName();
    //     $filename = pathinfo($filename, PATHINFO_FILENAME);
    //     $name_File = str_replace(" ", "_", $filename);
    //     $extension = $file->getClientOriginalExtension();
    //     $picture = date('His') . '-' . $name_File . '.' . $extension;
    //     $file->move(public_path('../../login/src/assets/'), $picture);
    // } else {
    //     return response()->json(["mensaje" => "No se pudo guardar la imagen"]);
    // }

    // Guardar los datos del vehículo en la base de datos
    $data = (object) $datosRec;
    $datos = (object) $data->vehiculo;

    $obgId = Vehiculo::find($datos->idvehiculo);

    if ($obgId == null) {
        $obgId = new Vehiculo();
        $obgId->idvehiculo = $datos->idvehiculo;
    }

    $obgId->marca = $datos->marca;
    $obgId->modelo = $datos->modelo;
    $obgId->color = $datos->color;
    $obgId->asiento = $datos->asiento;
    $obgId->combustible = $datos->combustible;
    $obgId->tipo = $datos->tipo;
    $obgId->ano = $datos->ano;
    $obgId->placa = $datos->placa;
    $obgId->precio = $datos->precio;
    // $obgId->imagen = $picture; // Asignar la ruta de la imagen guardada

    $resultado = $obgId->save();

    $retorno = (object) [];
    $retorno->resultado = $resultado;
    $retorno->id = $obgId->idvehiculo;

    return response()->json($retorno);
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
public function vehiculoInactivo()
{
    $objAll = vehiculo::where('estado', 0)->get();
    return response()->json($objAll);
}
        public function mostrarVehiculo()
        {
            $objAll = vehiculo::where('estado', 1)->get();
            return response()->json($objAll);
        }

        public function vehiculoMantenimiento()
        {
            $objAll = vehiculo::where('estado', 2)->get();
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



     public function bajoPrecio()
     {
        $carros = Vehiculo::where('precio','<',50)->get();
        return response()->json($carros);
     }

     public function medioPrecio()
     {
        $carros = Vehiculo::where('precio','<=',60)->where('precio','>=',50)->get();
        return response()->json($carros);
     }

     public function mayorPrecio()
     {
        $carros = Vehiculo::where('precio','>=',60)->get();
        return response()->json($carros);
     }

}




