<?php
require __DIR__ . '/vendor/autoload.php';
setlocale(LC_ALL, 'ru_RU.UTF-8');
error_reporting(E_ALL);
ini_set('display_errors', 'on');
date_default_timezone_set('Europe/Moscow');

define('AUDIO', 'media/audio/');

$view = new \Slim\Views\Twig();
$view->parserOptions = [
    'debug' => true,
    'cache' => false
];
$view->parserExtensions = [
    new \Slim\Views\TwigExtension(),
];

$app = new \Slim\Slim([
    'debug' => true,
    'templates.path' => __DIR__ . '/templates',
    'view' => $view,
]);