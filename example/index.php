<?php
    require_once __DIR__.'/../Router.php';
    $router = new Router();

    define('PAGES_PATH', __DIR__.'/pages');

    // add new GET route with the path "/routing _with_php/example/"
    // http://localhost/routing_with_php/example/
    $router->add('GET', '/routing_with_php/example/', function(Request $req, Response $res) {
        $res->send_file(PAGES_PATH.'/home.html', 200);
    });

    // add new POST route with the path "/routing _with_php/example/"
    // http://localhost/routing_with_php/example/
    $router->add('POST', '/routing_with_php/example/houses', function(Request $req, Response $res) {
        $res->send_file(PAGES_PATH.'/houses.html', 200);
    });

    $router->listen('header');

?>