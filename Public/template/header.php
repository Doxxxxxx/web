<?php
defined( '_PHP_CONGES' ) or die( 'Restricted access' );
include TEMPLATE_PATH . 'template_define.php';
global $environnement;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php /* FAVICONS */ ?>
        <link rel="apple-touch-icon" href="<?= IMG_PATH ?>Favicons/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="<?= IMG_PATH ?>Favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?= IMG_PATH ?>Favicons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= IMG_PATH ?>Favicons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= IMG_PATH ?>Favicons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?= IMG_PATH ?>Favicons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?= IMG_PATH ?>Favicons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?= IMG_PATH ?>Favicons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?= IMG_PATH ?>Favicons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= IMG_PATH ?>Favicons/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= IMG_PATH ?>Favicons/favicon-16x16.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= IMG_PATH ?>Favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= IMG_PATH ?>Favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?= IMG_PATH ?>Favicons/android-chrome-192x192.png">
        <link rel="manifest" href="<?= IMG_PATH ?>Favicons/manifest.json">
        <link rel="mask-icon" href="<?= IMG_PATH ?>Favicons/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-TileImage" content="<?= IMG_PATH ?>Favicons/mstile-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <?php /* JQUERY */ ?>
        <?php /* BOOTSTRAP */?>
        <link type="text/css" href="<?= NODE_PATH ?>bootstrap/dist/css/bootstrap.min.css?v=<?= $config_php_conges_version ?>" rel="stylesheet" media="screen">
        <?php /* FONT AWESOME */ ?>
        <link href="<?= ASSETS_PATH ?>font-awesome/css/font-awesome.min.css?v=<?= $config_php_conges_version ?>" rel="stylesheet">
        <?php /* REBOOT STYLE */ ?>
        <link type="text/css" href="<?= CSS_PATH ?>reboot.css?v=<?= $config_php_conges_version ?>" rel="stylesheet" media="screen">
        <?php /* SCRIPTS */ ?>
        <script>
        var _rollbarConfig = {
            accessToken: "<?= LOGGER_TOKEN ?>",
            captureUncaught: true,
            captureUnhandledRejections: true,
            payload: {
                environment: "<?= $environnement ?>",
                code_version : "<?= $config_php_conges_version ?>"
            }
        };
        </script>
        <script type="text/javascript" src="<?= JS_PATH ?>rollbar.js?v=<?= $config_php_conges_version ?>"></script>
        <script type="text/javascript" src="<?= NODE_PATH ?>jquery/dist/jquery.min.js?v=<?= $config_php_conges_version ?>"></script>
        <script type="text/javascript" src="<?= JS_PATH ?>reboot.js?v=<?= $config_php_conges_version ?>"></script>
        <?= $additional_head; ?>
    </head>
