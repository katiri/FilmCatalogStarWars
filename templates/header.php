<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Star Wars: Film Catalog</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- JQuery -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/themes/base/jquery-ui.min.css" integrity="sha512-TFee0335YRJoyiqz8hA8KV3P0tXa5CpRBSoM0Wnkn7JoJx1kaq1yXL/rb8YFpWXkMOjRcv5txv+C6UluttluCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- CSS -->
        <link rel="stylesheet" href="<?= $BASE_URL ?>static/css/base.css" />
        <link rel="stylesheet" href="<?= $BASE_URL ?>static/css/components.css" />
        <link rel="stylesheet" href="<?= $BASE_URL ?>static/css/links.css" />
        <link rel="stylesheet" href="<?= $BASE_URL ?>static/css/utilities.css" />
    </head>
    <body>
        <div id="header" class="container-fluid px-5 py-3 border-bottom border-color-standard">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="<?= $BASE_URL ?>static/images/logo_starwars.png" alt="Logo Star Wars" width="200px" class="pr-3 border-right border-white">
                    <h1 class="ml-3 font-weight-bold">
                        Film Catalog
                    </h1>
                </div>

                <nav id="menu" class="navbar navbar-expand-sm">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link link" href="<?= $BASE_URL ?>">Catalog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link" href="<?= $BASE_URL ?>watched/">Watched</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link" href="<?= $BASE_URL ?>tierlist/">Tier List</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>