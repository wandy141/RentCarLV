<?php

namespace App\Http\Controllers;

use App\Models\pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    function insertarPago(Request $request)
    {
        $datos = (object) $request;
        $pago = (object) $datos->pago;

        $objPago= pago::find($pago->idpago);

        if (!$objPago) {
            $objPago = new pago();
        }
        $objPago->idpago = $pago->idpago;
        $objPago->idcliente = $pago->idcliente;
        $objPago->nombretj = $pago->nombretj;
       
        $objPago->numerodetarjeta = $pago->numerodetarjeta;
        $objPago->mes = $pago->mes;
        $objPago->ano = $pago->ano;
        $objPago->codigocv = $pago->codigocv;
        $objPago->total = $pago->total;



        $resultado = $objPago->save();
        return response()->json($resultado);
    }
}

