<?php
    final class Request { 
        public string $path; 
        public string $method;
        public string $ip; 
        public object $body;
        public array $query_string;
        public array $post;
        public array $files;
        public array $headers;

        private function format_query_string(string $query_string_raw): array {
            $query_string = array();
            foreach(explode('&', $query_string_raw) as $query) {
                $explode_query = explode('=', $query);
                $query_string[$explode_query[0]] = isset($explode_query[1])? urldecode($explode_query[1]) : "";
                
            }
            return $query_string;
        }

        public function __construct(array $INFO) {
            $explode_path = explode('?', $INFO['REQUEST_URI']);
            $this->query_string = count($explode_path) > 1 
                ? $this->format_query_string(explode('?', $INFO['REQUEST_URI'])[1]) : array(); 
                
            $this->path = explode('?', $INFO['REQUEST_URI'])[0];
            $this->method = $_SERVER['REQUEST_METHOD'];
            $this->ip = $_SERVER['REMOTE_ADDR'];
            $this->headers = apache_request_headers();
            $this->body = json_decode(file_get_contents('php://input'));
            $this->post = $_POST;
            $this->files = $_FILES;
        }

    }
?>
