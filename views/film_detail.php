<?php
    require_once('templates/header.php');
?>
    <div class="container-fluid p-5">
        <a href="<?= $BASE_URL ?>" class="link">
            <i class="fas fa-arrow-left"></i> Back to catalog
        </a>
        <br>
        <br>
        <?php if(!isset($film['error'])): ?>
            <?php $film = $film['response']; ?>
            <div class="mb-3 border-bottom border-color-standard d-flex justify-content-between align-items-center">
                <h2>Film details</h2>

                <?php if(in_array($film->id, $watched)): ?>
                    <a href="" class="btn btn-sm btn-danger" onclick="updateWatchedCookie(<?= $film->id ?>);">I didn't watch</a>
                <?php else: ?>
                    <a href="" class="btn btn-sm btn-success" onclick="updateWatchedCookie(<?= $film->id ?>);">I watched</a>
                <?php endif; ?>
            </div>

            <h4 class="title-highligh">Name</h4>
            <p>Star Wars: <?= $film->name ?></p>

            <h4 class="title-highligh">Episode number</h4>
            <p>Episode <?= $film->episode_number ?></p>

            <h4 class="title-highligh">Synopsis</h4>
            <p><?= $film->synopsis ?></p>

            <h4 class="title-highligh">Release date</h4>
            <p><?= $film->getReleaseDate()->format('M d, Y') ?></p>
            
            <h4 class="title-highligh">Director</h4>
            <p><?= $film->director ?></p>
            
            <h4 class="title-highligh">Producer(s)</h4>
            <p><?= $film->producers ?></p>
            
            <h4 class="title-highligh">Names of characters</h4>
            <p><?= $film->getCharacterNames() ?></p>
            
            <h4 class="title-highligh">Film age</h4>
            <p><?= $film->getFullFilmAge() ?></p>
        <?php else: ?>
            <h6>Error <?= $film['http_code'] ?></h6>
            <h2><?= $film['error'] ?></h2>
        <?php endif; ?>
    </div>
<?php
    require_once('templates/footer.php');
?>