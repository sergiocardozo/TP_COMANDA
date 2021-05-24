<?php


require_once './models/Usuario.php';
require_once './interfaces/IApiUsable.php';

class UsuarioController extends Usuario implements IApiUsable
{
  public function CargarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();

    $nombre = $parametros['nombre'];
    $apellido = $parametros['apellido'];
    $rol = $parametros['rol'];
    $clave = $parametros['clave'];
    $usuario = $parametros['usuario'];
    $estado = $parametros['estado'];

    // Creamos el usuario
    $usr = new Usuario();
    $usr->nombre = $nombre;
    $usr->apellido = $apellido;
    $usr->rol = $rol;
    $usr->clave = $clave;
    $usr->usuario = $usuario;
    $usr->estado = $estado;
    $datos = Usuario::buscarRepetido($usr);
    if (is_array($datos) == true && count($datos) > 0) {
      $payload = json_encode(array("mensaje" => "El usuario ya existe"));
    } else {
      $usr->crearUsuario();
      $payload = json_encode(array("mensaje" => "Usuario creado con exito"));
    }

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerUno($request, $response, $args)
  {
    // Buscamos usuario por nombre
    $usr = $args['usuario'];
    $usuario = Usuario::obtenerUsuario($usr);
    $payload = json_encode($usuario);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodos($request, $response, $args)
  {
    $lista = Usuario::obtenerTodos();
    $payload = json_encode(array("listaUsuario" => $lista));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function ModificarUno($request, $response, $args)
  {
    $contador = 0;
    $parametros = $request->getParsedBody();
    $usuario = new Usuario();
    $usuario->id = $parametros['id'];
    $datos = Usuario::verificarId($usuario);
    if (is_array($datos) == true && count($datos) > 0) {

      if (array_key_exists('nombre', $parametros)) {
        $usuario->nombre = $parametros['nombre'];
        $contador++;
      }
      if (array_key_exists('apellido', $parametros)) {
        $usuario->apellido = $parametros['apellido'];
        $contador++;
      }
      if (array_key_exists('rol', $parametros)) {
        $usuario->rol = $parametros['rol'];
        $contador++;
      }
      if (array_key_exists('usuario', $parametros)) {
        $usuario->usuario = $parametros['usuario'];
        $contador++;
      }
      if (array_key_exists('clave', $parametros)) {
        $usuario->clave = $parametros['clave'];
        $contador++;
      }
      if (array_key_exists('estado', $parametros)) {
        $usuario->estado = $parametros['estado'];
        $contador++;
      }
      if ($contador > 0 && $contador <= 6) {
        Usuario::modificarUsuario($usuario);
        $payload = json_encode(array("mensaje" => "Usuario modificado con exito"));
      }
    } else {
      $payload = json_encode(array("mensaje" => "No se encontro el usuario"));
    }


    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function BorrarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();
    $usuario = new Usuario();
    $usuario->id = $parametros['id'];
    $datos = Usuario::verificarId($usuario);
    if (is_array($datos) == true && count($datos) > 0) {
      if (array_key_exists('estado', $parametros)) {
        $usuario->estado = $parametros['estado'];
      }
      Usuario::bajaUsuario($usuario);
      $payload = json_encode(array("mensaje" => "Estado usuario modificado con exito"));
    } else {
      
      $payload = json_encode(array("mensaje" => "Usuario no encontrado"));
    }

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function IniciarSesion($request, $response)
  {
    $parametros = $request->getParsedBody();
    $usuarios = new Usuario();
    $usuarios->usuario = $parametros['usuario'];
    $usuarios->clave = $parametros['clave'];
    $datos = Usuario::obtenerPorUsuario($usuarios);
    
    if($datos) {
      $token = AutentificadorJWT::CrearToken($datos);
      $payload = json_encode(array('jwt' => $token));
    }
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
  } 
  
}
