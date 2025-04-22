<?php
    class FilmController{
        private $url;
        private $api_url;

        public function __construct($url, $api_url){
            $this->url = $url;
            $this->api_url = $api_url;
        }

        public function list(){
            $data = [
                'BASE_URL' => $this->url,
                'API_URL' => $this->api_url,
            ];

            $this->render('film_list', $data);
        }

        public function detail($id){
            $data = [
                'BASE_URL' => $this->url,
                'API_URL' => $this->api_url,
                'id' => $id
            ];

            $this->render('film_detail', $data);
        }

        public function tierlist(){
            $data = [
                'BASE_URL' => $this->url,
                'API_URL' => $this->api_url,
            ];

            $this->render('film_tierlist', $data);
        }

        public function watched(){
            $data = [
                'BASE_URL' => $this->url,
                'API_URL' => $this->api_url,
            ];

            $this->render('film_watched', $data);
        }

        private function render($view, $data = []) {
            extract($data);
            require __DIR__ . "/../views/{$view}.php";
        }
    }