<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\token;
use App\Models\usuario;

class usuarioToken extends Controller
{
    public function getNombre(Request $datai)
    {
        $data = (object) $datai;
        $token = $data -> token;
        $nombre = '';

        $session = token::find($token);

        if($session != null) 
        {
        $usuarioId = $session->usuarioid;
        $usuario = usuario::find($usuarioId);
        $nombre = $usuario->nombre;
        }
        return response()->json($nombre);

    }
}
