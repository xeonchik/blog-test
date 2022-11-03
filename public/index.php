<?php
declare(strict_types=1);

use Blog\Application;
use Blog\ApplicationContainerFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

require_once __DIR__ . '/../vendor/autoload.php';

$request = ServerRequestFactory::fromGlobals();

$container = (new ApplicationContainerFactory())->init();
$app = new Application($container);
$response = $app->handle($request);

(new SapiEmitter())->emit($response);
