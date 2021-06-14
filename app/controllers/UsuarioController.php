<?php

use \App\Models\Usuario;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once './models/Usuario.php';
require_once './interfaces/IApiUsable.php';

class UsuarioController implements IApiUsable
{
  public function CargarUno(Request $request, Response $response, $args)
  {
    $parametros = $request->getParsedBody();
    $nombre = $parametros['nombre'];
    $apellido = $parametros['apellido'];
    $rol = $parametros['rol'];
    $clave = $parametros['clave'];
    $usuario = $parametros['usuario'];
    $estado = $parametros['estadoEmpleado'];
    // Creamos el usuario
    $usr = new Usuario();
    $usr->nombre = $nombre;
    $usr->apellido = $apellido;
    $usr->rol = $rol;
    $usr->clave = $clave;
    $usr->usuario = $usuario;
    $usr->estadoEmpleado = $estado;
    $datos = $usr->where('usuario', '=', $parametros["usuario"])
      ->where('nombre', '=', $parametros["nombre"])
      ->where('apellido', '=', $parametros["apellido"])->first();
    if ($datos) {
      $payload = json_encode(array("error" => "el usuario ya existe"));
    } else {
      $usr->save();
      $payload = json_encode(array("mensaje" => "usuario creado"));
    }
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerUno($request, $response, $args)
  {
    // Buscamos usuario por nombre
    $usr = $args['usuario'];
    $usuario = Usuario::where('id', $usr)->first();
    $payload = json_encode($usuario);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodos($request, $response, $args)
  {
    $lista = Usuario::all();
    $payload = json_encode(array("listaUsuario" => $lista));

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
      $datos = Usuario::find($id);
    }
    if($id != null && $datos != null) {
         
      if (array_key_exists('nombre', $parametros)) {
        $datos->nombre = $parametros['nombre'];
        $contador++;
      }
      if (array_key_exists('apellido', $parametros)) {
        $datos->apellido = $parametros['apellido'];
        $contador++;
      }
      if (array_key_exists('rol', $parametros)) {
        $datos->rol = $parametros['rol'];
        $contador++;
      }
      if (array_key_exists('usuario', $parametros)) {
        $datos->usuario = $parametros['usuario'];
        $contador++;
      }
      if (array_key_exists('clave', $parametros)) {
        $datos->clave = $parametros['clave'];
        $contador++;
      }
      if (array_key_exists('estadoEmpleado', $parametros)) {
        $datos->estadoEmpleado = $parametros['estado'];
        $contador++;
      }
      
      if ($contador > 0 && $contador <= 6) {
        $datos->save();
        $payload = json_encode(array("mensaje" => "Usuario modificado con exito"));
      }
    } else if ($id == null){
      $payload = json_encode(array("error" => "No se encontro el usuario"));
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
    $datos = Usuario::where('id', '=', $parametros['id'])->delete();
    if ($datos) {
      $payload = json_encode(array("mensaje" => "Usuario dado de baja"));
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

    $usuario = Usuario::where('usuario', '=', $parametros['usuario'])
      ->select('id', 'usuario', 'clave', 'rol', 'nombre', 'apellido', 'estadoEmpleado')
      ->get();
    if (count($usuario) == 1 && $usuario[0]['clave'] == $parametros['clave']) {
      if($usuario[0]['estadoEmpleado'] == "Activo"){

        unset($usuario[0]['clave']);
        
        $token = AutentificadorJWT::CrearToken($usuario[0]);
        $payload = json_encode(array('jwt' => $token  . ' Usuario: ' . $usuario[0]['usuario']));
      } else {
        $payload = json_encode(array('error' => 'Usuario dado de baja'));
      }
      
    } else {
      $payload = json_encode(array('error' => 'No existe el usuario'));
    }
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
  }
}
