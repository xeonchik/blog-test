<?php
declare(strict_types=1);

use Blog\Application;
use Laminas\Diactoros\ServerRequestFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$request = ServerRequestFactory::fromGlobals();

$app = new Application();
