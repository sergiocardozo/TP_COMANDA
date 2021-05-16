<?php
require_once './models/Producto.php';
require_once './interfaces/IApiUsable.php';

class ProductoController extends Producto implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $descripcion = $parametros['descripcion'];
        $precio = $parametros['precio'];
        $idRol = $parametros['idRol'];
        $tiempoPreparacion = $parametros['tiempoPreparacion'];

        // Creamos el producto
        $prducto = new Producto();
        $prducto->descripcion = $descripcion;
        $prducto->precio = $precio;
        $prducto->idRol = $idRol;
        $prducto->tiempoPreparacion = $tiempoPreparacion;
        $prducto->crearProducto();

        $payload = json_encode(array("mensaje" => "Producto creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos producto por nombre
        $prducto = $args['producto'];
        $producto = Producto::obtenerProducto($prducto);
        $payload = json_encode($producto);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Producto::obtenerTodos();
        $payload = json_encode(array("listaProductos" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $producto = new Producto();
        $producto->descripcion = $parametros['descripcion'];
        $producto->precio = $parametros['precio'];
        $producto->tiempoPreparacion = $parametros['tiempoPreparacion'];
        Producto::modificarProducto($producto);
        $payload = json_encode(array("mensaje" => "Producto modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $productoDescripcion = $parametros['descripcion'];
        Producto::borrarProducto($productoDescripcion);

        $payload = json_encode(array("mensaje" => "Producto borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
