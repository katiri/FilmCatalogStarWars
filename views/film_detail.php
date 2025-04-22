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
                <a href="<?= $BASE_URL ?>" class="link">
                    <i class="fas fa-arrow-left"></i> Back to catalog
                </a>
                <br><br>
                <div id="film-div"></div>
            </div>

            <div id="error" class="d-none"></div>
        </div>
        
        <?php require_once('templates/footer.php'); ?>
        <?php require_once('templates/scripts.php'); ?>

        <!-- JS -->
        <script src="<?= $BASE_URL ?>static/js/cookies.js"></script>
        <script src="<?= $BASE_URL ?>static/js/watched.js"></script>
        <script src="<?= $BASE_URL ?>static/js/consults.js"></script>

        <script>
            film_detail('<?= $BASE_URL ?>', '<?= $API_URL ?>', <?= $id ?>);
        </script>
    </body>
</html>