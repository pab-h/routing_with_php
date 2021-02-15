<?php 
    final class Response {
        public function status(int $code) {
            http_response_code($code);
        }

        public function send(array $json, int $code = 200) {
            $this->status($code);
            echo json_encode($json);
        }

        public function send_file(string $path, int $code = 200) {
            $this->status($code);
            require_once $path;
        }
    }
?>