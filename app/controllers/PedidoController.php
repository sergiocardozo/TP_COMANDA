<?php
require_once './models/Pedido.php';
require_once './models/Producto.php';
require_once './models/Productos_pedidos.php';
require_once './models/Mesa.php';
require_once './models/Venta.php';
require_once './interfaces/IApiUsable.php';

use \App\Models\Pedido;
use \App\Models\Producto;
use \App\Models\Productos_pedidos;
use App\Models\Usuario;
use \App\Models\Venta;

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
    $id = null;
    $pedido = null;
    $contadorModificaciones = 0;
    if (array_key_exists("id", $parametros)) {
      $id = $parametros['id'];
      $pedido = Pedido::find($id);
    }

    if (array_key_exists("producto", $parametros) && $id != null && $pedido != null) {
      $pedido->producto = $parametros["producto"];
      $contadorModificaciones++;
      //Borra el pedido de productos antiguo y lo reemplaza por el nuevo en 
      //la tabla producto_pedido
      Productos_pedidos::where("codigoPedido", "=", $pedido->codigoPedido)->delete();
      $productos = explode(",", $parametros["producto"]);
      for ($i = 0; $i < count($productos); $i++) {
        $pedido_producto = new Productos_pedidos();
        $pedido_producto->codigoPedido = $pedido->codigoPedido;
        $pedido_producto->idProducto = $productos[$i];
        $pedido_producto->estadoProducto = "Pendiente";
        $pedido_producto->save();
      }
    }
    if (array_key_exists("idUsuario", $parametros) && $id != null && $pedido != null) {
      $pedido->idUsuario = $parametros["idUsuario"];
      $contadorModificaciones++;
    }
    if (array_key_exists("nombreCliente", $parametros) && $id != null && $pedido != null) {
      $pedido->nombreCliente = $parametros["nombreCliente"];
      $contadorModificaciones++;
    }
    if ($contadorModificaciones > 0 && $contadorModificaciones <= 6 && $id != null && $pedido != null) {
      $pedido->estadoPedido = "Pendiente";
      $pedido->save();
      $payload = json_encode(array("mensaje" => "Pedido modificado con exito"));
    } else if ($id == null) {
      $payload = json_encode(array("error" => "El id no es valido"));
    } else if ($id != null && $pedido == null) {
      $payload = json_encode(array("error" => "No existe pedido con ese id"));
    } else {
      $payload = json_encode(array("error" => "No hay modificaciones"));
    }

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
  public static function CambiarEstado($codigoPedido, $estadoPedido)
  {
    $pedido = Pedido::where('codigoPedido', $codigoPedido)->first();
    $pedido->estadoPedido = $estadoPedido;
    if ($estadoPedido == "Listo Para Servir") { //listo para servir
      $pedido->tiempo = 0;
    }
    $pedido->save();
  }
  public static function CambiarEstadoPedidosProducto($codigo, $encargado, $estadoInicial, $estadoactual)
  {
    $ret = false;
    $data = Productos_pedidos::where('estadoProducto', '=', $estadoInicial)
      ->where('codigoPedido', '=', $codigo)
      ->get();
    foreach ($data as $value) {
      $prod = Producto::where('id', '=', $value->idProducto)->first();
      if ($encargado == "Socio") {
        $value->estadoProducto = $estadoactual;
        $value->save();
        $ret = true;
      } else if ($encargado != "Socio") {
        $value->estadoProducto = $estadoactual;
        $value->save();
        $ret = true;
      }
    }
    return $ret;
  }
  public function PrepararPedido($request, $response, $args)
  {
    $header = $request->getHeaderLine('Authorization');
    $token = trim(explode("Bearer", $header)[1]);
    $data = AutentificadorJWT::ObtenerData($token);
    $parametros = $request->getParsedBody();

    $respuesta = self::CambiarEstadoPedidosProducto($parametros["codigoPedido"], $data->rol, "Pendiente", "En Preparacion");
    if ($respuesta) {
      pedidoController::CambiarEstado($parametros["codigoPedido"], 'En Preparacion');
      $payload = json_encode(array("mensaje" => "Preparando el pedido"));
    } else {
      $payload = json_encode(array("error" => "El pedido no existe"));
    }
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
  public function TerminarPedido($request, $response, $args)
  {
    $header = $request->getHeaderLine('Authorization');
    $token = trim(explode("Bearer", $header)[1]);
    $data = AutentificadorJWT::ObtenerData($token);
    $parametros = $request->getParsedBody();
    $respuesta = self::CambiarEstadoPedidosProducto($parametros["codigoPedido"], $data->rol, "En Preparacion", "Listo Para Servir");

    if ($respuesta) {
      $data = Productos_pedidos::where('codigoPedido', $parametros["codigoPedido"])->get();
      $completo = true;
      foreach ($data as $value) {
        if ($value->estadoProducto != "Listo Para Servir") {
          $completo = false;
        }
      }
      if ($completo) {
        pedidoController::CambiarEstado($parametros["codigoPedido"], "Listo Para Servir");
        self::CambiarEstadoPedidosProducto($parametros["codigoPedido"], $data->rol, "En Preparacion", "Listo Para Servir");
        $payload = json_encode(array("mensaje" => "Se preparon todos los productos. Pedido listo para servir"));
      } else {
        $payload = json_encode(array("mensaje" => "Se finalizo la preparacion de los productos"));
      }
    } else {
      $payload = json_encode(array("mensaje" => "No hay productos pendiente para este pedido"));
    }
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function ServirPedido($request, $response, $args)
  {
    $parametros = $request->getParsedBody();
    $pedido = Pedido::where('codigoPedido', $parametros["codigoPedido"])->first();
    if ($pedido->estadoPedido == "Listo Para Servir") {
      mesaController::cambiarEstado($pedido->codigoMesa, "Comiendo");

      pedidoController::cambiarEstado($parametros["codigoPedido"], "Servido");

      self::CambiarEstadoPedidosProducto($parametros["codigoPedido"], "Socio", "Listo Para Servir", "Servido");
      $tiempoEntrada = $pedido->created_at;
      $tiempoSalida = $pedido->update_at;
      $pedido->tiempo = $tiempoEntrada->diff($tiempoSalida);
      $payload = json_encode(array("mensaje" => "Pedido entregado"));
    } else {
      $payload = json_encode(array("mensaje" => "El pedido no esta listo para ser entregado"));
    }
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
  public function CobrarPedido($request, $response, $args)
  {
    $total = 0;
    $parametros = $request->getParsedBody();
    $pedido = Pedido::where('codigoPedido', '=', $parametros['codigoPedido'])->first();
    if ($pedido != null && $pedido->estadoPedido == "Servido") {
      $venta = new Venta();
      $venta->codigoPedido = $pedido->codigoPedido;
      $productos = Productos_pedidos::join('productos', 'productos.id', 'productos_pedidos.idProducto')
        ->where('codigoPedido', '=', $parametros['codigoPedido'])->get();
      foreach ($productos as $producto) {
        $total = $total + $producto->precio;
      }
      $venta->precioTotal = $total;
      $venta->mesa = $pedido->codigoMesa;
      $usuarioPedido = Usuario::where('id', '=', $pedido->idUsuario)->first();
      $venta->usuario = $usuarioPedido->usuario;
      $venta->save();
      
      pedidoController::cambiarEstado($parametros['codigoPedido'], "Cobrado"); 
      mesaController::cambiarEstado($pedido->codigoMesa, "Libre"); 
      $payload = json_encode(array("mensaje" => "Pedido cobrado - Mesa Cerrada"));
    } else {
      $payload = json_encode(array("mensaje" => "Pedido no encontrado"));
    }

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
}
