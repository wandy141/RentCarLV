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
            ->whereIn('estado', [0, 1, 2])
            ->first();
    
        if ($consulta !== null && $consulta->count() > 0) {
            $estado = $consulta->estado;
    
            if ($estado == 1) {
                $sessiones = token::where('usuarioid', $usuario)->get();
    
                if (count($sessiones) > 0) {
                    $session = $sessiones[0];
                } else {
                    $session = new token();
                }
    
                $time = new DateTime();
                $time->add(new DateInterval('PT' . 10 . 'M')); // agregar 10 min a la hora actual
    
                $token = $usuario . '123';
                $session->token = $token;
                $session->usuarioid = $usuario;
                $session->fechavalida = $time;
    
                $session->save();
    
                $respuesta = true;
            } else {
                $respuesta = true;
            }
        } else {
            $respuesta = false;
            
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
            $usuario = usuario::find($objSeccionXid->usuarioid);

            $fecha_actual = date('Y-m-d H:i:s');
            //return response()->json([$fecha_actual, $time]);
            if ($fecha_actual > $time) {
                $expira =  false;
            } else if ($usuario->estado == 1) {
                $expira =  true;
            } else {
                $expira =  false;
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
