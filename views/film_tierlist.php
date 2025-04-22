<!DOCTYPE html>
<html lang="pt-br">
    <?php require_once('templates/head.php'); ?>
    <body>
        <?php require_once('templates/header.php'); ?>
        <div class="container-fluid p-5">
            <div id="loader" class="text-center my-4">
                <div class="spinner-border text-white" role="status"></div>
            </div>
            
            <div id="content" class="d-none">
                <div class="row">
                    <div class="col px-0 py-3 text-right">
                        <a href="" class="btn btn-dark" onclick="deleteCookie('tierlist');">Clear tier list</a>
                    </div>
                </div>
                <div id="ranks"></div>
                
                <br>

                <div class="row">
                    <div class="col p-0">
                        <ul id="rank_none" class="droptrue"></ul>
                    </div>
                </div>
            </div>
            
            <div id="error" class="d-none"></div>
        </div>
        
        <?php require_once('templates/footer.php'); ?>
        <?php require_once('templates/scripts.php'); ?>

        <!-- JS -->
        <script src="<?= $BASE_URL ?>static/js/cookies.js"></script>
        <script src="<?= $BASE_URL ?>static/js/tierlist.js"></script>   
        <script src="<?= $BASE_URL ?>static/js/consults.js"></script>

        <script>
            film_tierlist('<?= $BASE_URL ?>', '<?= $API_URL ?>');
        </script>
    </body>
</html>