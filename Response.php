<?php 
    final class Response {
        public function status(int $code): void {
            http_response_code($code);
        }

        public function send(array $json, int $code = 200): void {
            $this->status($code);
            echo json_encode($json);
        }

        public function render(string $path, int $code = 200, array $data = array()): void {
            $this->status($code);
            require_once $path;
        }

        public function redirect(string $to): void {
            header("Location: $to");
        } 

        public function stop(string $redirect = NULL): void {
            if(!is_null($redirect)) {
                $this->redirect($redirect);
            }
            exit;
        }

    }
?>