<?php
    final class Request { 
        public string $path; 
        public string $method;
        public string $ip; 
        public string $body;
        public string $query_string;
        public array $post;
        public array $files;
        public array $headers;

        public function __construct(array $INFO) {
            $explode_path = explode('?', $INFO['REQUEST_URI']);
            $this->query_string = count($explode_path) > 1 
                ? explode('?', $INFO['REQUEST_URI'])[1] : ""; 
                
            $this->path = explode('?', $INFO['REQUEST_URI'])[0];
            $this->method = $_SERVER['REQUEST_METHOD'];
            $this->ip = $_SERVER['REMOTE_ADDR'];
            $this->headers = apache_request_headers();
            $this->body = file_get_contents('php://input');
            $this->post = $_POST;
            $this->files = $_FILES;
        }

    }
?>