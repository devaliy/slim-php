<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/api/subjects', function (Request $request, Response $response, $args) {
 
    $database = new App\Database;

    $repository = new App\Repositories\SubjectRepository($database);

    $data = $repository->getAll();

    $body = json_encode($data);
    $response->getBody()->write($body);
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();