<?php
    class Film{
        public $id;
        public $name;
        public $episode_number;
        public $synopsis;
        public $release_date;
        public $director;
        public $producers;
        public $character_names;
        public $film_age;

        public function getFullName(){
            return 'Star Wars: ' . $this->name . ' (Episode ' . $this->episode_number . ')';
        }

        public function getReleaseDate(){
            $release_date = new DateTime($this->release_date);

            return $release_date;
        }

        public function getFullFilmAge(){
            $film_age = $this->film_age;

            return  $film_age['years'] . ' years, ' . $film_age['months'] . ' months and ' . $film_age['days'] . ' days';
        }

        public function getCharacterNames(){
            $character_names = $this->character_names;

            if(!isset($character_names['error'])){
                $character_names = implode(', ', $character_names);
            }
            else{
                $character_names = '<span class="text-danger">Error ' . $character_names['http_code'] . '<br>' . $character_names['error'] . '</span>';
            }

            return $character_names;
        }
    }

    interface FilmDAOInterface{
        public function buildFilm($data);
        public function list();
        public function findById($id);
        public function consultAPI($url);
    }