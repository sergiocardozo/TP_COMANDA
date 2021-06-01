<?php

use GuzzleHttp\Psr7\Response;

require_once './models/Mesa.php';
require_once './interfaces/IApiUsable.php';

class MesaController extends Mesa implements IApiUsable
{
  public function CargarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();

    $codigoMesa = $parametros['codigoMesa'];
    $estadoMesa = $parametros['estadoMesa'];

    // Creamos el producto
    $mesa = new Mesa();
    $mesa->codigoMesa = $codigoMesa;
    $mesa->estadoMesa = $estadoMesa;
    $mesa->crearMesa();

    $payload = json_encode(array("mensaje" => "Mesa creada con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerUno($request, $response, $args)
  {
    // Buscamos producto por nombre
    $msa = $args['mesa'];
    $mesa = Mesa::obtenerMesa($msa);
    $payload = json_encode($mesa);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodos($request, $response, $args)
  {
    $lista = Mesa::obtenerTodos();
    $payload = json_encode(array("listaMesa" => $lista));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function ModificarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();
    $mesa = new Mesa();
    $mesa->codigoMesa = $parametros['codigoMesa'];
    $mesa->estadoMesa = $parametros['estadoMesa'];
    $mesa->id = $parametros['id'];
    Mesa::modificarMesa($mesa);
    $payload = json_encode(array("mensaje" => "Mesa modificada con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public static function CambiarEstado($codigoMesa, $nuevoEstado)
  {

    $mesa = new Mesa();
    $mesa->estadoMesa = $nuevoEstado;
    $mesa->codigoMesa = $codigoMesa;
    Mesa::cambiarEstadoMesa($mesa);
  }

  public static function TraerMesaLibre()
  {
    $mesaLibre = Mesa::obtenerMesasDisponibles("Libre");
    foreach($mesaLibre as $value){
      if ($mesaLibre != null) {
        $newResponse = $value->codigoMesa;
        self::cambiarEstado($value->codigoMesa, "Esperando");
      } else {
        $newResponse = null;
      }
      break;
    }    
    return $newResponse;
  }
}
