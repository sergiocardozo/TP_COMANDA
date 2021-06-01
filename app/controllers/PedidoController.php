<?php
require_once './models/Pedido.php';
require_once './models/Productos_pedidos.php';
require_once './models/Mesa.php';
require_once './interfaces/IApiUsable.php';

class PedidoController extends Pedido implements IApiUsable
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
    $tiempo = 1;
    $productoExistente = null;
    $arrayDeProductosExistentes = "";
    $mesaDisponible = MesaController::TraerMesaLibre();
    if ($mesaDisponible != null) {
      MesaController::CambiarEstado($mesaDisponible, "Esperando");
      $pedidos = new Pedido();
      $pedidos->estadoPedido = "Recibido";
      $pedidos->codigoMesa = $mesaDisponible;
      $pedidos->codigoPedido = self::generarCodigo();

      foreach ($data as $value) {
        $pedidos->idUsuario = $value->id;
      }
      $pedidos->nombreCliente = $parametros['nombreCliente'];
      $archivo = $request->getUploadedFiles();
      if (array_key_exists("imagen", $archivo)) {
        $pedidos->imagen = $_FILES['imagen']['tmp_name'];
      }
      $pedidos->tiempo = $tiempo;
      $pedidos->crearPedido();

      $idPedidoCargado = $pedidos->id;
      $productos = explode(",", $parametros['producto']);
      for ($i = 0; $i < count($productos); $i++) {
        $productoExistente = Producto::obtenerProductoNombre($productos[$i]);
        if ($productoExistente != null) {
          if ($i == 0) {
            $arrayDeProductosExistentes = $arrayDeProductosExistentes . $productos[$i];
            var_dump($arrayDeProductosExistentes);
          } else if (empty($arrayProductosExisten)) {
            $arrayDeProductosExistentes = $arrayDeProductosExistentes . $productos[$i];
          } else {
            $arrayDeProductosExistentes = $arrayDeProductosExistentes . "," . $productos[$i];
          }
          $pedidoProducto = new Productos_pedidos();
          $pedidoProducto->codigoPedido = $pedidos->codigoPedido;
          $pedidoProducto->idProducto = $productoExistente->id;
          $pedidoProducto->estadoProducto = "Pendiente";
          $pedidoProducto->crearPedidoProducto();
        }
      }
      if (strlen($arrayDeProductosExistentes) > 0) {
        $pedidos->producto = $arrayDeProductosExistentes;
        $tiempo = Pedido::ObtenerDiferenciaMinutos($pedidos->id);
        if ($tiempo > $pedidos->tiempo) {
          $pedidos->tiempo = $tiempo;
        }
        $pedidos->crearPedido();
        $payload = json_encode(array("pedido " . $pedidos->codigoPedido . "-" . $pedidos->codigoMesa . " cargado"));
      } else {
        MesaController::CambiarEstado($pedidos->codigoMesa, "Libre");
        Pedido::borrarPedido($idPedidoCargado);
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
    $pedido = Pedido::obtenerPedido($pdido);
    $payload = json_encode($pedido);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodos($request, $response, $args)
  {
    $lista = Pedido::obtenerTodos();
    if (count($lista) > 0) {
      $payload = json_encode(array("listaPedidos" => $lista));
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

    $idPedido = $parametros['id'];
    Pedido::borrarPedido($idPedido);

    $payload = json_encode(array("mensaje" => "Pedido borrado con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
}
