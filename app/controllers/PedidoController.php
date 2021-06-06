<?php
require_once './models/Pedido.php';
require_once './models/Producto.php';
require_once './models/Productos_pedidos.php';
require_once './models/Mesa.php';
require_once './interfaces/IApiUsable.php';

use \App\Models\Pedido;
use \App\Models\Producto;
use \App\Models\Productos_pedidos;

class PedidoController implements IApiUsable
{
  public static function generarCodigo()
  {
    $lenght = 5;
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $largoCaracteres = strlen($caracteres);
    $randomString = '';

    for ($i = 0; $i < $lenght; $i++) {
      $randomString .= $caracteres[rand(0, $largoCaracteres - 1)];
    }
    return $randomString;
  }
  public function CargarUno($request, $response, $args)
  {
    $header = $request->getHeaderLine('Authorization');
    $token = trim(explode("Bearer", $header)[1]);
    $data = AutentificadorJWT::ObtenerData($token);
    $parametros = $request->getParsedBody();
    $tiempo = 0;
    $productoExistente = null;
    $arrayDeProductosExistentes = "";
    $mesaDisponible = MesaController::TraerMesaLibre();
    if ($mesaDisponible != null) {
      MesaController::CambiarEstado($mesaDisponible, "Esperando");
      $pedidos = new Pedido();
      $pedidos->estadoPedido = "Recibido";
      $pedidos->codigoMesa = $mesaDisponible;
      $pedidos->codigoPedido = self::generarCodigo();

      $pedidos->producto = $parametros['producto'];
      $pedidos->idUsuario = $data->id;

      $pedidos->nombreCliente = $parametros['nombreCliente'];
      $archivo = $request->getUploadedFiles();
      if (array_key_exists("imagen", $archivo)) {
        $pedidos->imagen = $_FILES['imagen']['tmp_name'];
      }
      $pedidos->tiempo = 1;
      $pedidos->save();

      $idPedidoCargado = $pedidos->id;
      $productos = explode(",", $parametros['producto']);

      for ($i = 0; $i < count($productos); $i++) {
        $productoExistente = Producto::find($productos[$i]);
        if ($productoExistente != null) {
          if ($i == 0) {
            $arrayDeProductosExistentes = $arrayDeProductosExistentes . $productos[$i];
          } else if (empty($arrayProductosExisten)) {
            $arrayDeProductosExistentes = $arrayDeProductosExistentes . $productos[$i];
          } else {
            $arrayDeProductosExistentes = $arrayDeProductosExistentes . "," . $productos[$i];
          }
          $pedidoProducto = new Productos_pedidos();
          $pedidoProducto->codigoPedido = $pedidos->codigoPedido;
          $pedidoProducto->idProducto = $productoExistente->id;
          $pedidoProducto->estadoProducto = "Pendiente";
          $pedidoProducto->save();
        }
      }
      if (strlen($arrayDeProductosExistentes) > 0) {
        var_dump($arrayDeProductosExistentes);
        $pedidos->producto = $arrayDeProductosExistentes;
        $pedidos->save();
        $payload = json_encode(array("pedido " . $pedidos->codigoPedido . "-" . $pedidos->codigoMesa . " cargado"));
      } else {
        MesaController::CambiarEstado($pedidos->codigoMesa, "Libre");
        Pedido::where("id", '=', $idPedidoCargado)->delete();
        $pedidos->delete();

        $payload = json_encode(array("error " => "No se puede cargar un pedido sin productos.Pedido Eliminado"));
      }
    } else {
      $payload = json_encode(array("error " => "No hay mesas libre"));
    }
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  

  public function TraerUno($request, $response, $args)
  {
    // Buscamos producto por nombre
    $pdido = $args['pedido'];
    $pedidos = Pedido::where('id', $pdido)->first();
    $payload = json_encode($pedidos);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodos($request, $response, $args)
  {
    $todosLasPedidos = Pedido::all();
    if (count($todosLasPedidos) > 0) {
      $payload = json_encode(array("listaPedidos" => $todosLasPedidos));
    } else {
      $payload = json_encode(array("mensaje" => "No hay pedidos"));
    }

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function ModificarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();
    $pedido = new Pedido();
    $pedido->estadoPedido = $parametros['estadoPedido'];
    $pedido->codigoMesa = $parametros['codigoMesa'];
    $pedido->idUsuario = $parametros['idUsuario'];
    $pedido->producto = $parametros['producto'];
    $pedido->codigoPedido = $parametros['codigoPedido'];
    Pedido::modificarPedido($pedido);
    $payload = json_encode(array("mensaje" => "Pedido modificado con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function BorrarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();

    $id = $parametros['id'];
    $pedido = Pedido::find($id);
    var_dump($pedido);
    if ($pedido != null) {
      $pedido->delete();
      Productos_pedidos::where("codigoPedido", "=", $pedido->codigoPedido)->delete();
      $payload = json_encode(array("mensaje" => "Pedido borrado con exito"));
    } else {
      $payload = json_encode(array("error" => "El pedido no existe"));
    }

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
}
