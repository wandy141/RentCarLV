<?php

namespace App\Http\Controllers;

use App\Models\renta;
use App\Models\usuario;
use App\Models\token;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DateInterval;
use DateTime;

class RentaController extends Controller
{
    public function _invoke()
    {
        return view('index');
    }


    public function login(Request $data)
    {
        $data = (object) $data;
    
        $usuario = $data->usuarioid;
        $contrasena = $data->contrasena;
        $estado = $data->estado;
        $respuesta = false;
        $token = '';
    
        $consulta = usuario::where('usuarioid', $usuario)
                           ->where('contrasena', $contrasena)
                           ->whereIn('estado', [0,1,2])
                           ->first();
    
        if ($consulta) {
            $estado = $consulta->estado;
    
            if ($estado == 0 || $estado == 1 || $estado == 2) {
                $token = $usuario . '123';
                $respuesta = true;
            } else {
                return response()->json(['mensaje' => 'El estado no cumple con los criterios requeridos.'], 403);
            }
        }
    
        if ($respuesta) {
            $retorno = (object) array('resultado' => $respuesta, 'token' => $token, 'estado' => $estado);
        } else {
            $retorno = (object) array('resultado' => $respuesta, 'token' => '', 'estado' => $estado);
        }
    
        return response()->json($retorno);
    }


    public function expira(Request $datai)
    {
        $objToken = (object) $datai;
        $idSeccion = $objToken->seccion;

        $objSeccionXid = token::find($idSeccion);
        $expira =  false;

        if ($objSeccionXid != null) {
            $time = $objSeccionXid->fechavalida;


            $fecha_actual = date('Y-m-d H:i:s');
            //return response()->json([$fecha_actual, $time]);
            if ($fecha_actual > $time) {
                $expira =  false;
            } else {
                $expira =  true;
            }
        } else {
            $expira = false;
        }

        return response()->json($expira);
    }



    //buscar por el id
    public function usuarioid(Request $data)
    {
        $data = (object) $data;
        $usuario = $data->usuarioid;

        // $consulta = usuario::where('usuarioid',$usuario)->get();
        $consulta = usuario::find($usuario);


        return response()->json($consulta);
    }

    //Muestra todos los usuarios
    public function usuarios()
    {
        $usuarios = usuario::all();
        return response()->json($usuarios);
    }

    //si pones un usuario y no existe se cree 
    //y si existe y le pones por ejemplo a nombre otro nombre diferente se actualiza
    public function storeUser(Request $data)
    {
        $data = (object) $data;
        $usuario = (object) $data->usuario;

        $objUsuario = usuario::find($usuario->usuarioid);

        if ($objUsuario == null) {
            $objUsuario = new usuario();
            $objUsuario->usuarioid = $usuario->usuarioid;
            $objUsuario->contrasena = $usuario->contrasena;
            $objUsuario->nombre = $usuario->nombre;
            $objUsuario->estado = $usuario->estado;
        } else {
            $objUsuario->contrasena = $usuario->contrasena;
            $objUsuario->nombre = $usuario->nombre;
            $objUsuario->estado = $usuario->estado;
        }


        $resultado = $objUsuario->save();
        return response()->json($resultado);
    }



    //eliminar


    public function destroyUser($usuarioid)
{
    // return response()->json($usuarioid);
    // $data = (object)$usuarioid;
    // $dato = $data->usuarioid;

    $user = usuario::find($usuarioid);

    if (!$user) {
        $resultado = false;
    } else {
       $user->delete();
       $resultado = true;
    }         
    return response()->json($resultado); 
    }

}



    