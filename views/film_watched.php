<?php
    require_once('templates/header.php');
?>
    <div class="container-fluid p-5">
        <a href="<?= $BASE_URL ?>" class="link">
            <i class="fas fa-arrow-left"></i> Back to catalog
        </a>
        <br>
        <br>
        <?php if(!isset($list_films['error'])): ?>
            <?php if($watched): ?>
                <div class="mb-3 border-bottom border-color-standard">
                    <h2>Movies Watched (<?= count($watched) ?>)</h2>
                </div>
                <div class="row">
                    <?php foreach($watched as $film): ?>
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

                                <a href="" class="watched-btn btn btn-sm btn-danger" onclick="updateWatchedCookie(<?= $film->id ?>);">I didn't watch</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>    
            <?php else: ?>
                <h2>No movies watched</h2>
            <?php endif; ?>
        <?php else: ?>
            <h6>Error <?= $list_films['http_code'] ?></h6>
            <h2><?= $list_films['error'] ?></h2>
        <?php endif; ?>
    </div>
<?php
    require_once('templates/footer.php');
?>