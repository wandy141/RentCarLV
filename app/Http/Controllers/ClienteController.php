<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function cliente(Request $data) {
        $datos = (object) $data;
        $cliente = (object) $datos->cliente;
    
        $objCliente = cliente::find($cliente->idcliente);
    
        if (!$objCliente) {
            $objCliente = new cliente();
        }
    
        $objCliente->idcliente = $cliente->idcliente;
        $objCliente->nombre = $cliente->nombre;
        $objCliente->correo = $cliente->correo;
        $objCliente->cedula = $cliente->cedula;
        
        $resultado = $objCliente->save();
        return response()->json($resultado);
    }


public function todoCliente()
{
    $consulta = cliente::all();
    return response()->json($consulta);
    }


    
public function clienteId(Request $datai)
{
    $data=(object) $datai;
    $cliente = $data->idcliente;

   $consulta = cliente::find($cliente);
    return response()->json($consulta);
}

    
}
