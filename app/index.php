<?php
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;
use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__ . '/../vendor/autoload.php';

/* require_once './db/AccesoDatos.php'; */
require_once './middlewares/AuthJWT.php';
require_once './middlewares/MWAccesos.php';
require_once './middlewares/MWLogger.php';

require_once './controllers/UsuarioController.php';
require_once './controllers/ProductoController.php';
require_once './controllers/MesaController.php';
require_once './controllers/PedidoController.php';

// Load ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addBodyParsingMiddleware();

$app->addRoutingMiddleware();

$app->addErrorMiddleware(true, true, true);

//Eloquent
/* $container=$app->getContainer();

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $_ENV['MYSQL_HOST'],
    'database'  => $_ENV['MYSQL_DB'],
    'username'  => $_ENV['MYSQL_USER'],
    'password'  => $_ENV['MYSQL_PASS'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]); */
$container=$app->getContainer();

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'BALwohnmpu',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
// Routes
$app->group('/login', function (RouteCollectorProxy $group) {
  $group->post('/iniciarSesion/', \UsuarioController::class . ':IniciarSesion');
});

$app->group('/usuarios', function (RouteCollectorProxy $group) {
  $group->get('[/]', \UsuarioController::class . ':TraerTodos');
  $group->get('/{usuario}', \UsuarioController::class . ':TraerUno');
  $group->post('/cargarUno/', \UsuarioController::class . ':CargarUno');
  $group->post('/modificarUno/', \UsuarioController::class . ':ModificarUno');
  $group->post('/bajaEmpleado/', \UsuarioController::class . ':BorrarUno');
})/* ->add(\MWAccesos::class . ':EsSocio')
  ->add(\MWLogger::class . ':log')
  ->add(\MWAccesos::class . ':ValidarToken') */;

$app->group('/productos', function (RouteCollectorProxy $group) {
  $group->get('/{producto}', \ProductoController::class . ':TraerUno');
  $group->get('[/]', \ProductoController::class . ':TraerTodos');
  $group->post('/cargarUnProducto/', \ProductoController::class . ':CargarUno')
    ->add(\MWAccesos::class . ':EsSocio');
  $group->post('/modificarUno/', \ProductoController::class . ':ModificarUno')
    ->add(\MWAccesos::class . ':EsSocio');
  $group->post('/cambiarEstado/', \ProductoController::class . ':EstadoProducto')
    ->add(\MWAccesos::class . ':EsSocio');
})->add(\MWLogger::class . ':log')
  ->add(\MWAccesos::class . ':ValidarToken');

$app->group('/mesa', function (RouteCollectorProxy $group) {
  $group->get('/{mesa}', \MesaController::class . ':TraerUno');
  $group->get('[/]', \MesaController::class . ':TraerTodos');  
  $group->post('[/]', \MesaController::class . ':CargarUno');
  $group->post('/modificarUna/', \MesaController::class . ':ModificarUno');
  
});

$app->group('/pedido', function (RouteCollectorProxy $group) {
  $group->post('[/]', \PedidoController::class . ':CargarUno');
  $group->get('/{pedido}', \PedidoController::class . ':TraerUno');
  $group->get('[/]', \PedidoController::class . ':TraerTodos');
  $group->put('[/]', \PedidoController::class . ':ModificarUno');
  $group->delete('[/]', \PedidoController::class . ':BorrarUno');
});

$app->get('[/]', function (Request $request, Response $response) {
  $response->getBody()->write("TP_COMANDA by Cardozo Sergio Esteban");
  return $response;
});

$app->run();
