<?php
    require_once('models/Film.php');

    class FilmDAO implements FilmDAOInterface{
        private $api_url;

        public function __construct($api_url){
            $this->api_url = $api_url;
        }

        public function buildFilm($data){
            $film = new Film();

            $film->id = $data['id'];
            $film->name = $data['name'];
            $film->episode_number = $data['episode_number'];
            $film->synopsis = $data['synopsis'];
            $film->release_date = $data['release_date'];
            $film->director = $data['director'];
            $film->producers = $data['producers'];
            $film->character_names = $data['characters'];
            $film->film_age = $data['film_age'];

            return $film;
        }

        public function list(){
            $films = [];

            $url = $this->api_url . 'films/'; 
            $response = $this->consultAPI($url);

            if(isset($response['output'])){
                if($response['http_code'] === 200){
                    $data = json_decode($response['output'], true);

                    $id = 1;
                    foreach($data as $film){
                        $data_processed = [
                            'id' => $id,
                            'name' => $film['name'],
                            'episode_number' => $film['episode_number'],
                            'synopsis' => $film['synopsis'],
                            'release_date' => $film['release_date'],
                            'director' => $film['director'],
                            'producers' => $film['producers'],
                            'characters' => $film['characters'],
                            'film_age' => $film['film_age']
                        ];

                        $films[] = $this->buildFilm($data_processed);

                        $id++;
                    }
                    
                    return [
                        'response' => $films
                    ];
                }
                else{
                    return [
                        'http_code' => $response['http_code'],
                        'error' => json_decode($response['output'], true)['error']
                    ];
                }
            }
            else{
                return $response;
            }
        }

        public function findById($id){
            $url = $this->api_url . 'films/' . $id . '/'; 
            $response = $this->consultAPI($url);

            if(isset($response['output'])){
                if($response['http_code'] === 200){
                    $data = json_decode($response['output'], true);

                    $data = [
                        'id' => $id,
                        'name' => $data['name'],
                        'episode_number' => $data['episode_number'],
                        'synopsis' => $data['synopsis'],
                        'release_date' => $data['release_date'],
                        'director' => $data['director'],
                        'producers' => $data['producers'],
                        'characters' => $data['characters'],
                        'film_age' => $data['film_age']
                    ];

                    $film = $this->buildFilm($data);

                    return [
                        'response' => $film
                    ];
                }
                else{
                    return [
                        'http_code' => $response['http_code'],
                        'error' => json_decode($response['output'], true)['error']
                    ];
                }
            }
            else{
                return $response;
            }
        }

        public function consultAPI($url){
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $output = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            $curl_errno = curl_errno($ch);
            $curl_error = curl_error($ch);

            curl_close($ch);

            if(!$curl_errno){
                return [
                    'http_code' => $http_code,
                    'output' => $output,
                ];
            }
            else{
                return [
                    'http_code' => $http_code,
                    'error' => $curl_error
                ];
            }
        }
    }