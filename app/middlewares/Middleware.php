<?php

class Middleware
{
    public function ValidarToken($request, $response, $next)
    {
        $token = $request->getHeader('token');
        if ($token != null) {
            try {
                if (AutentificadorJWT::VerificarToken($token[0])) {
                    $newResponse = $next($request, $response);
                }
            } catch (Exception $e) {
                $newResponse = $response->withJson("Token invalido", 200);
            }
        } else {
            $newResponse = $response->withJson("Token no recibido", 200);
        }
        return $newResponse;
    }

    public function EsSocio($request, $response, $next)
    {
        $token = $request->getHeader('token');
        if ($token != null) {
            try {
                $token = $request->getHeader('token')[0];
                $data = AutentificadorJWT::ObtenerData($token);
                if ($data->cargo === "socio") {
                    $newResponse = $next($request, $response);
                } else {
                    $newResponse = $response->withJson("Solo se admiten socios para esta operacion", 401);
                }
            } catch (Exception $e) {
                $newResponse = $response->withJson("Fallo en la funcion", 500);
            }
        } else {
            $newResponse = $response->withJson("No se ha recibido un token. Verificar e intentar nuevamente", 500);
        }
        return $newResponse;
    }
    public function EsMozo($request, $response, $next)
    {

        $token = $request->getHeader('token');

        if (count((array)$token) > 0) {
            try {

                $data = AutentificadorJWT::ObtenerData($token[0]);
                if ($data->cargo === "mozo" || $data->cargo === "socio") {
                    $newResponse = $next($request, $response);
                } else {
                    $newResponse = $response->withJson("Esta accion solo la puede cumplir un mozo", 200);
                }
            } catch (\Exception $e) {
                $newResponse = $response->withJson("Ha ocurrido un error Mozo. Verificar" . $e, 200);
            }
        } else {
            $newResponse = $response->withJson("No se ha recibido un token. Verificar", 200);
        }
        return $newResponse;
    }
}
