<?php

use \App\Models\Encuesta;

require_once './models/Encuesta.php';
class EncuestaController
{

    public static function altaEncuesta($request, $response)
    {
        $parametros = $request->getParsedBody();

        // Creamos el producto
        $encuesta = new Encuesta();
        $encuesta->codigoPedido = $parametros['codigoPedido'];
        $encuesta->puntosMesa = $parametros['puntosMesa'];
        $encuesta->puntosMozo = $parametros['puntosMozo'];
        $encuesta->puntosRestaurante = $parametros['puntosRestaurante'];
        $encuesta->puntosCocinero = $parametros['puntosCocinero'];
        $encuesta->comentarios = $parametros['comentarios'];
        $datos = $encuesta->where('codigoPedido', '=', $parametros['codigoPedido'])->exists();

        if ($datos) {
            $payload = json_encode(array("error" => "Ya se realizo la encuesta de este pedido"));
        } else {
            $encuesta->save();
            $payload = json_encode(array("mensaje" => "Encuesta realizada con exito"));
        }

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
