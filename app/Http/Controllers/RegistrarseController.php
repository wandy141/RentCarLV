<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\registrarse;
use App\Models\usuario;

class RegistrarseController extends Controller
{
    public function InsertarRegistro(Request $data)
    {
        //print($data);

        $datos = (object) $data;
        $registro = (object) $datos->registro;
        $user = (object) $datos->usuarios;

        $objRegistro = registrarse::find($registro->idcliente);
        $objuser = usuario::find($user->usuarioid);

        if (!$objRegistro && !$objuser) {
            $objRegistro = new registrarse();
            $objuser = new usuario();

            $objRegistro->idcliente = $registro->idcliente;
            $objRegistro->nombreCom = $registro->nombreCom;
            $objRegistro->correo = $registro->correo;
            $objRegistro->contrasena = $registro->contrasena;

            $objuser->usuarioid = $user->usuarioid;
            $objuser->nombre = $user->nombre;
            $objuser->contrasena = $user->contrasena;
            $objuser->estado = $user->estado;
            $objuser->save();
            $resultado = $objRegistro->save();
        } else {
            $resultado = false;
        }



        return response()->json($resultado);
    }
    public function verificarUsuarioExistente(Request $request)
    {
        $correo = $request->input('idcliente');
        $existeUsuario = registrarse::where('idcliente', $correo)->exists();

        return response()->json($existeUsuario);
    }
}
