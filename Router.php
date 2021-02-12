<?php
    
    require_once __DIR__.'/Request.php';

    final class Router {
        private $routes = array();

        public function get_routes(): array {
            return $this->routes;
        }

        private function get_route(string $method, string $path): array {
            foreach($this->routes as $route) {
                if($route['method'] === $method && $route['path'] === $path) {
                    return $route;
                }
            }

            throw new Exception('HTTP/1.0 404 Not Found', 404);
        }

        public function add(string $method, string $path, callable $handler): void {
            if(!substr($path, -1) === '/') {
                $path .= '/';
            }

            array_push($this->routes, array (
                'method' => strtoupper($method),
                'path' => $path,
                'handler' => $handler
            ));
        }

        public function listen(callable $error_callback): void {
            $req = new Request($_SERVER);

            if(!(substr($req->path, -1) == '/')) {
                $req->path .= '/';
            }

            try {
                $route = $this->get_route($req->method, $req->path);
                $route['handler']($req);

            } catch(Exception $e) {
                $error_callback($e->getMessage());
            }
        }

    }
?>
