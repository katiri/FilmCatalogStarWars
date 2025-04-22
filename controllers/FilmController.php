<?php
    require_once('dao/FilmDAO.php');

    class FilmController{
        private $filmDao;
        private $url;
        private $api_url;

        public function __construct($url, $api_url){
            $this->url = $url;
            $this->api_url = $api_url;

            $this->filmDao = new FilmDAO($api_url);
        }

        public function list(){
            $list_films = $this->filmDao->list();
            $watched = [];
            
            if(!isset($list_films['error'])){
                $list_films = $list_films['response'];

                if(isset($_COOKIE['watched'])){
                    $json = urldecode($_COOKIE['watched']);
                    $watched = json_decode($json, true);
                }
            }

            $data = [
                'BASE_URL' => $this->url,
                'list_films' => $list_films,
                'watched' => $watched
            ];

            $this->render('film_list', $data);
        }

        public function detail($id){
            $film = $this->filmDao->findById($id);
            $watched = [];

            if(isset($_COOKIE['watched'])){
                $json = urldecode($_COOKIE['watched']);
                $watched = json_decode($json, true);
            }

            $data = [
                'BASE_URL' => $this->url,
                'film' => $film,
                'watched' => $watched
            ];

            $this->render('film_detail', $data);
        }

        public function tierlist(){
            $list_films = $this->filmDao->list();
            
            if(!isset($list_films['error'])){
                $list_films = $list_films['response'];
            }

            if(isset($_COOKIE['tierlist'])){
                $json = urldecode($_COOKIE['tierlist']);
                $tierlist = json_decode($json, true);
            }
            else{
                $tierlist = false;
            }

            $ranks = [
                'rank_s' => 'Rank S',
                'rank_a' => 'Rank A',
                'rank_b' => 'Rank B',
                'rank_c' => 'Rank C',
                'rank_d' => 'Rank D'
            ];

            $data = [
                'BASE_URL' => $this->url,
                'list_films' => $list_films,
                'tierlist' => $tierlist,
                'ranks' => $ranks
            ];

            $this->render('film_tierlist', $data);
        }

        public function watched(){
            $list_films = $this->filmDao->list();
            $watched = false;

            if(!isset($list_films['error'])){
                $list_films = $list_films['response'];

                if(isset($_COOKIE['watched'])){
                    $json = urldecode($_COOKIE['watched']);
                    $watched_ids = json_decode($json, true);

                    $watched = [];
                    foreach($list_films as $film){
                        if(in_array($film->id, $watched_ids)){
                            $watched[] = $film;
                        }
                    }
                }
            }

            $data = [
                'BASE_URL' => $this->url,
                'list_films' => $list_films,
                'watched' => $watched
            ];

            $this->render('film_watched', $data);
        }

        private function render($view, $data = []) {
            extract($data);
            require __DIR__ . "/../views/{$view}.php";
        }
    }