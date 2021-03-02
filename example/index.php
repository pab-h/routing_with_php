<?php
    require_once __DIR__.'/../Router.php';
    $router = new Router();

    define('PAGES_PATH', __DIR__.'/pages');

    // add new GET route with the path "/routing _with_php/example/"
    // http://localhost/routing_with_php/example/
    $router->add('GET', '/routing_with_php/example/', function(Request $req, Response $res) {
        $res->render(PAGES_PATH.'/home.html', 200);
    });

    // add new POST route with the path "/routing _with_php/example/"
    // http://localhost/routing_with_php/example/
    $router->add('POST', '/routing_with_php/example/houses', function(Request $req, Response $res) {
        $res->render(PAGES_PATH.'/houses.html', 200);
    });

    // middleware exemple
    $router->add('GET', '/routing_with_php/example/middleware', 
        function(Request $req, Response $res){
            if(!array_key_exists('access-token', $req->headers)) {
                $res->redirect('.');
                $res->stop();
            }  
        },
        function(Request $req, Response $res){
            $res->render(PAGES_PATH.'/needTokenToAccess.html', 200);
        }
    );

    // it is possible to pass date to page
    $router->add('GET', '/routing_with_php/example/parsedata', function(Request $req, Response $res) {
        $res->render(PAGES_PATH.'/parseData.php', 200, array(
            'title' => "Any title",
            'page' => 'parse data exemple'
        ));
    });

    // crucial method for the operation of routing.
    $router->listen(function(string $error, Request $req, Response $res) {
        $res->send(array(
            'error' => $error
        ), 404);
    });
?>