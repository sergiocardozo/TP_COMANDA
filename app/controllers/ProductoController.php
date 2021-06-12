<?php

use \App\Models\Producto;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once './models/Producto.php';
require_once './interfaces/IApiUsable.php';

class ProductoController implements IApiUsable
{
  public function CargarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();

    $descripcion = $parametros['descripcion'];
    $precio = $parametros['precio'];
    $rol = $parametros['rol'];

    // Creamos el producto
    $producto = new Producto();
    $producto->descripcion = $descripcion;
    $producto->precio = $precio;
    $producto->rol = $rol;
    $datos = $producto->where('descripcion', '=', $parametros['descripcion'])->exists();
    if ($datos > 0) {
      $payload = json_encode(array("error" => "El producto ya existe"));
    } else {
      $producto->save();
      $payload = json_encode(array("mensaje" => "Producto creado con exito"));
    }

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerUno($request, $response, $args)
  {
    // Buscamos producto por id
    $prducto = $args['producto'];
    $producto = Producto::where('id', $prducto)->first();
    $payload = json_encode($producto);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodos($request, $response, $args)
  {
    $lista = Producto::all();
    $payload = json_encode(array("listaProductos" => $lista));

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
      $datos = Producto::find($id);
    }
    if ($id != null && $datos != null) {
      if (array_key_exists('descripcion', $parametros)) {
        $datos->descripcion = $parametros['descripcion'];
        $contador++;
      }
      if (array_key_exists('precio', $parametros)) {
        $datos->precio = $parametros['precio'];
        $contador++;
      }
      if (array_key_exists('rol', $parametros)) {
        $datos->rol = $parametros['rol'];
        $contador++;
      }
      if ($contador > 0 && $contador <= 3) {
        $datos->save();
        $payload = json_encode(array("mensaje" => "Producto modificado con exito"));
      }
    } else if ($id == null) {
      $payload = json_encode(array("error" => "El id ingresado no existe"));
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

    $datos = Producto::where('id', '=', $parametros['id'])->delete();
    if ($datos) {
      $payload = json_encode(array("mensaje" => "Producto dado de baja"));
    } else {

      $payload = json_encode(array("error" => "Producto no encontrado"));
    }


    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function CargarDatosCsv(Request $request, $response, $args)
  {
    $archivotmp = $_FILES['archivo']['tmp_name'];

    $lineas = file($archivotmp);
    $i = 0;
    foreach ($lineas as $linea_num => $linea) {
      $datos = explode(",", $linea);
      if ($i != 0) {
        $pducto = Producto::where('descripcion', '=', $datos[0])->first();
        if ($pducto != true) {
          $producto = new Producto();
          $producto->descripcion = $datos[0];
          $producto->precio = $datos[1];
          $producto->rol = $datos[2];

          $producto->save();
          $payload = json_encode(array("producto " . $producto->descripcion . " cargado correctamente"));
        } else {
          $payload = json_encode(array("Los productos de la lista ya existen en la Base de datos"));
        }
      }
      $i++;
    }
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
}
