<?php
    final class Request { 
        public string $path; 
        public string $method;
        public string $ip; 
        public string $body;
        public array $query_string;
        public array $post;
        public array $headers;

        public function __construct(array $INFO) {
            $this->query_string = $_GET ? $_GET : array();
            $this->path = explode('?', $INFO['REQUEST_URI'])[0];
            $this->method = $_SERVER['REQUEST_METHOD'];
            $this->ip = $_SERVER['REMOTE_ADDR'];
            $this->headers = apache_request_headers();
            $this->body = file_get_contents('php://input');
            $this->post = $_POST;
        }

    }
?>