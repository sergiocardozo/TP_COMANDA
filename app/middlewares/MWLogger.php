<?php
require_once './models/Log.php';
use \App\Models\Log;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class MWLogger
{
    public function log(Request $request, RequestHandler $handler): Response
    {
        $header = $request->getHeaderLine('Authorization');
        $response = new Response();
        if ($header) {
            $token = trim(explode("Bearer", $header)[1]);
            try {
                $data = AutentificadorJWT::ObtenerData($token);
                if (!empty($data)) {
                    $ruta = $request->getRequestTarget();
                    $metodo = $request->getMethod();
                    $ip = $request->getServerParams("REMOTE_ADDR");

                    $log = new Log();
                    $log->usuario = $data->usuario;
                    $log->ruta = $ruta;
                    $log->metodo = $metodo;
                    $log->ip = $ip["REMOTE_ADDR"];
                    $log->save();
                }
            } catch (Exception $e) {
                $response->getBody()->write(json_encode(array("error" => "Token Invalido")));
                $response->withStatus(200);
            }
        }
        return $response->withHeader('Content-Type', 'application/json');
    }
}
