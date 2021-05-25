<?php

use Firebase\JWT\JWT;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class MWAccesos
{
    public function ValidarToken(Request $request, RequestHandler $rHandler) : Response
    {
        $header = $request->getHeaderLine('Authorization');
        $response = new Response();
        if(!empty($header)){
            $token = trim(explode("Bearer", $header)[1]);
            AutentificadorJWT::VerificarToken($token);
            $response = $rHandler->handle($request);
        } else {
            $response->getBody()->write(json_encode(array("error" => "Falta ingresar el token")));
            $response = $response->withStatus(401);

        }
        return  $response->withHeader('Content-Type', 'application/json');
    }

    public function EsSocio(Request $request, RequestHandler $handler): Response
    {
        $header = $request->getHeaderLine('authorization');
        $response = new Response();
        if (!empty($header)) {
            $token = trim(explode("Bearer", $header)[1]);
            $data = AutentificadorJWT::ObtenerData($token);
            foreach ($data as $value) {
                if ($value->rol === "Socio") {
                    $response = $handler->handle($request);
                } else {
                    $response->getBody()->write(json_encode(array("error" => "Solo los socios tienen acceso")));
                    $response = $response->withStatus(401);
                }
            }
        } else {
            $response->getBody()->write(json_encode(array("error" => "Falta ingresar el token")));
            $response = $response->withStatus(401);
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
    public function EsMozo(Request $request, RequestHandler $handler): Response
    {
        $header = $request->getHeaderLine('authorization');
        $response = new Response();
        if (!empty($header)) {
            $token = trim(explode("Bearer", $header)[1]);
            $data = AutentificadorJWT::ObtenerData($token);
            foreach ($data as $value) {
                if ($value->rol === "Mozo") {
                    $response = $handler->handle($request);
                } else {
                    $response->getBody()->write(json_encode(array("error" => "Solo los socios tienen acceso")));
                    $response = $response->withStatus(401);
                }
            }
        } else {
            $response->getBody()->write(json_encode(array("error" => "Falta ingresar el token")));
            $response = $response->withStatus(401);
        }
        return $response->withHeader('Content-Type', 'application/json');
    }
}
