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
        $rol = $parametros['rol'];
        $estado = $parametros['estado'];

        // Creamos el producto
        $prducto = new Producto();
        $prducto->descripcion = $descripcion;
        $prducto->precio = $precio;
        $prducto->rol = $rol;
        $prducto->estado = $estado;
        $prducto->crearProducto();

        $payload = json_encode(array("mensaje" => "Producto creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos producto por id
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
        $producto->rol = $parametros['rol'];
        $producto->estado = $parametros['estado'];
        $producto->id = $parametros['id'];
        Producto::modificarProducto($producto);
        var_dump(Producto::modificarProducto($producto));
        $payload = json_encode(array("mensaje" => "Producto modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function EstadoProducto($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $producto = new Producto();
        $producto->id = $parametros['id'];
        $producto->estado = $parametros['estado'];
        Producto::bajaProducto($producto);
        $payload = json_encode(array("mensaje" => "Producto modificado con exito"));


        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
