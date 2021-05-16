<?php
require_once './models/Pedido.php';
require_once './interfaces/IApiUsable.php';

class PedidoController extends Pedido implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $idEstadoPedido = $parametros['idEstadoPedido'];
        $codigoPedido = $parametros['codigoPedido'];
        $codigoMesa = $parametros['codigoMesa'];
        $idUsuario = $parametros['idUsuario'];
        $producto = $parametros['producto'];
        $nombreCliente = $parametros['nombreCliente'];
        $tiempo = $parametros['tiempo'];
        
        // Creamos el producto
        $pedidos = new Pedido();
        $pedidos->idEstadoPedido = $idEstadoPedido;
        $pedidos->codigoPedido = $codigoPedido;
        $pedidos->codigoMesa = $codigoMesa;
        $pedidos->idUsuario = $idUsuario;
        $pedidos->producto = $producto;
        $pedidos->nombreCliente = $nombreCliente;
        $archivo = $request->getUploadedFiles();
        if(array_key_exists("imagen", $archivo)){
          $pedidos->imagen = $_FILES['imagen']['tmp_name'];
        }
        $pedidos->tiempo = $tiempo;
        $pedidos->crearPedido();

        $payload = json_encode(array("mensaje" => "Mesa creada con exito"));

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
        $payload = json_encode(array("listaPedidos" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $pedido = new Pedido();
        $pedido->idEstadoPedido = $parametros['idEstadoPedido'];
        $pedido->codigoMesa = $parametros['codigoMesa'];
        $pedido->idUsuario = $parametros['idUsuario'];
        $pedido->producto = $parametros['producto'];
        $pedido->codigoPedido = $parametros['codigoPedido'];
        Pedido::modificarPedido($pedido);
        $payload = json_encode(array("mensaje" => "Mesa modificada con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $idMesa = $parametros['id'];
        Pedido::borrarPedido($idMesa);

        $payload = json_encode(array("mensaje" => "Mesa borrada con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
