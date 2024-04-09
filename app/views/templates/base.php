<?php $url = get_url() ; ($url == "" )? $baniere = 'hero': $baniere ="beadcrump" ; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?= "/" . APP_NAME . "/public/" ?>">
    <?php include viewComponent('head') ?>
</head>

<body>
    <?php include viewComponent('header') ?>
    <?php include viewComponent($baniere) ?>
    <main id="main">
        <?= $content ?>
    </main>
    <?php include viewComponent('footer') ?>
    <?php include viewComponent('script') ?>
</body>

</html>