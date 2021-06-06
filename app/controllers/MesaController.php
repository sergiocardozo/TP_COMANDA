<?php

use GuzzleHttp\Psr7\Response;
use \App\Models\Mesa;

require_once './models/Mesa.php';
require_once './interfaces/IApiUsable.php';

class MesaController implements IApiUsable
{
  public function CargarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();

    $codigoMesa = $parametros['codigoMesa'];

    // Creamos el producto
    $mesa = new Mesa();
    $mesa->codigoMesa = $codigoMesa;
    $mesa->estadoMesa = "Libre";
    $datos = $mesa->where('codigoMesa', '=', $parametros['codigoMesa'])->exists();
    if ($datos) {
      $payload = json_encode(array("error" => "La mesa ya existe"));
    } else {
      $mesa->save();
      $payload = json_encode(array("mensaje" => "Mesa creada con exito"));
    }

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerUno($request, $response, $args)
  {
    // Buscamos producto por nombre
    $msa = $args['mesa'];
    $mesa = Mesa::where('id', $msa)->first();
    $payload = json_encode($mesa);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodos($request, $response, $args)
  {
    $lista = Mesa::all();
    $payload = json_encode(array("listaMesa" => $lista));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function ModificarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();
    $contador = 0;
    $id = null;
    $datos = null;

    if (array_key_exists('id', $parametros)) {
      $id = $parametros['id'];
      $datos = Mesa::find($id);
    }
    if ($id != null && $datos != null) {

      if (array_key_exists('codigoMesa', $parametros)) {
        $datos->codigoMesa = $parametros['codigoMesa'];
        $contador++;
      }
      if (array_key_exists('estadoMesa', $parametros)) {
        $datos->estadoMesa = $parametros['estadoMesa'];
        $contador++;
      }
      if ($contador > 0 && $contador <= 2) {
        $datos->save();
        $payload = json_encode(array("mensaje" => "Mesa modificada con exito"));
      }
    } else if ($id == null) {
      $payload = json_encode(array("error" => "No se encontro la mesa"));
    } else {
      $payload = json_encode(array("error" => "No hubo modificaciones"));
    }

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function BorrarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();
    $datos = Mesa::where('id', '=', $parametros['id'])->delete();
    if ($datos) {
      $payload = json_encode(array("mensaje" => "Usuario dado de baja"));
    } else {

      $payload = json_encode(array("mensaje" => "Usuario no encontrado"));
    }

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
  public static function CambiarEstado($codigoMesa, $nuevoEstado)
  {
    $mesa = Mesa::where('codigoMesa', '=', $codigoMesa)->first();
    $mesa->estadoMesa = $nuevoEstado;
    $mesa->save();
  }

  public static function TraerMesaLibre()
  {
    $mesaLibre = Mesa::where('estadoMesa', '=', 'Libre')
      ->select('codigoMesa')->first();
    if ($mesaLibre != null) {
      $respuesta = $mesaLibre->codigoMesa;
      self::CambiarEstado($mesaLibre->codigoMesa, "Libre");
    } else {
      $respuesta = null;
    }
    return $respuesta;
  }
}
