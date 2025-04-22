<?php
    require_once('templates/header.php');
?>
    <div class="container-fluid p-5">
        <?php if(!isset($list_films['error'])): ?>
            <div class="mb-3 border-bottom border-color-standard">
                <h2>All Films (<?= count($list_films) ?>)</h2>
            </div>
            <div class="row">
                <?php foreach($list_films as $film): ?>
                    <div class="col-lg-3 col-md-4 p-2">
                        <div class="film-card h-100">
                            <a href="<?= $BASE_URL ?>detail/<?= $film->id ?>">
                                <img src="<?= $BASE_URL ?>static/images/standard_image_movies.png" width="100%">
                                <div class="p-4">
                                    <h4 class="title">
                                        <i class="fas fa-film"></i>
                                        <?= $film->getFullName() ?>
                                    </h4>
                                    <br>
                                    Release date: <?= $film->getReleaseDate()->format('d/m/Y') ?>
                                </div>
                            </a>

                            <?php if(in_array($film->id, $watched)): ?>
                                <a href="" class="watched-btn btn btn-sm btn-danger" onclick="updateWatchedCookie(<?= $film->id ?>);">I didn't watch</a>
                            <?php else: ?>
                                <a href="" class="watched-btn btn btn-sm btn-success" onclick="updateWatchedCookie(<?= $film->id ?>);">I watched</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>    
        <?php else: ?>
            <h6>Error <?= $list_films['http_code'] ?></h6>
            <h2><?= $list_films['error'] ?></h2>
        <?php endif; ?>
    </div>
<?php
    require_once('templates/footer.php');
?>