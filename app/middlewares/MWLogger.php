<?php
require_once './models/Log.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class MWLogger
{
    public function log(Request $request, RequestHandler $handler): Response
    {
        $header = $request->getHeaderLine('Authorization');
        $usuario = "";
        $response = new Response();
        if ($header) {
            $token = trim(explode("Bearer", $header)[1]);
            try {
                $data = AutentificadorJWT::ObtenerData($token);
                foreach ($data as $value) {
                    if ($value->usuario != null) {
                        
                        $response = $handler->handle($request);
                        $ruta = $request->getRequestTarget();
                        $metodo = $request->getMethod();
                        $ip = $request->getServerParams("REMOTE_ADDR");
                        
                        $log = new Log();
                        $log->usuario = $value->usuario;
                        $log->ruta = $ruta;
                        $log->metodo = $metodo;
                        $log->ip = $ip["REMOTE_ADDR"];
                        $log->CrearLog();
                    }
                }
            } catch (Exception $e) {
                $response->getBody()->write(json_encode(array("error" => "Token Invalido")));
                $response->withStatus(200);
            }

            return $response->withHeader('Content-Type', 'application/json');
        }
    }
}
