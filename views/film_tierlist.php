<?php
    require_once('templates/header.php');
?>
    <div class="container-fluid p-5">
        <?php if(!isset($list_films['error'])): ?>
            <div class="row">
                <div class="col px-0 py-3 text-right">
                    <a href="" class="btn btn-dark" onclick="deleteCookie('tierlist');">Clear tier list</a>
                </div>
            </div>
            <?php foreach($ranks as $rank_id => $rank): ?>
                <div class="row">
                    <div id="tier_<?= $rank_id ?>" class="tier_rank col-2 d-flex justify-content-center align-items-center p-4 tier-rank">
                        <?= $rank ?>
                    </div>
                    <div class="col-10 p-0">
                        <ul id="<?= $rank_id ?>" class="droptrue">
                            <?php if($tierlist): ?>
                                <?php foreach($tierlist[$rank_id] as $item): ?>
                                    <li class="ui-state-default ui-sortable-handle"><?= $item ?></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <hr>

            <div class="row">
                <div class="col p-0">
                    <ul id="rank_none" class="droptrue">
                        <?php if($tierlist): ?>
                            <?php foreach($tierlist['rank_none'] as $item): ?>
                                <li class="ui-state-default"><?= $item ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php foreach($list_films as $film): ?>
                                <li class="ui-state-default"><?= $film->getFullName() ?></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <h6>Error <?= $list_films['http_code'] ?></h6>
            <h2><?= $list_films['error'] ?></h2>
        <?php endif; ?>
    </div>
<?php
    require_once('templates/footer.php');
?>