<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?= "/" . APP_NAME . "/public/" ?>">
    <?php include viewComponent('head') ?>
</head>

<body>
    <?php include viewComponent('header') ?>
    <?php include viewComponent('hero') ?>
    <main id="main">
        <?= $content ?>
    </main>
    <?php include viewComponent('footer') ?>
    <?php include viewComponent('script') ?>
</body>

</html>