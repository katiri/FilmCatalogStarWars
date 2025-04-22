<?php
    $BASE_URL = 'http://' . $_SERVER["SERVER_NAME"] . dirname(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']) . "?");
    $BASE_URL = rtrim($BASE_URL, '/') . '/';

    $API_URL = 'http://localhost/projects/Projetos%20pessoais/Dados%20Star%20Wars/';

    date_default_timezone_set('America/Sao_Paulo');
    
    $scriptName = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

    $uri = urldecode($_SERVER['REQUEST_URI']);

    $uri = explode('?', $uri)[0];

    if($scriptName !== '/'){
        $uri = str_replace($scriptName, '', $uri);
    }

    $uri = '/' . ltrim(rtrim($uri, '/'), '/') . '/';
    
    $routes = [
        '//' => 'FilmController@list',
        '/detail/(\d+)/' => 'FilmController@detail',
        '/tierlist/' => 'FilmController@tierlist',
        '/watched/' => 'FilmController@watched',
    ];

    $routeFound = false;
    foreach($routes as $pattern => $action){
        $pattern = "#^" . $pattern . "$#";
        
        if(preg_match($pattern, $uri, $matches)){
            $routeFound = true;

            array_shift($matches);

            $matches_implode = implode(',', $matches);

            if(substr_count($matches_implode, ',') > count($matches) - 1){
                $matches = [$matches];
            }

            list($controller, $method) = explode('@', $action);

            require_once __DIR__ . "/controllers/{$controller}.php";

            $controllerInstance = new $controller($BASE_URL, $API_URL);
            call_user_func_array([$controllerInstance, $method], $matches);
            break;
        }
    }

    if(!$routeFound){
        http_response_code(404);
        require_once('templates/404.php');
    }