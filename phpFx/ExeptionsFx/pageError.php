<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Div Fixe</title>

    <style>
        .error {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: #f0f0f0;
            z-index: 1000;
            /* Vous pouvez ajuster ceci en fonction de vos besoins */
        }
    </style>
</head>

<body>

    <div class="error">
        <h1>Fx ERROR</h1>
        <?php if (isset($errorMessage)) : ?>
            <p><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <?php if (isset($errorfile)) : ?>
            <h3>Error Details</h3>
            <pre><?php echo $errorfile; ?></pre>
        <?php endif; ?>

        <?php if (isset($errorDetails)) : ?>
            <pre><?php echo $errorDetails; ?></pre>
        <?php endif; ?>

        <?php if (isset($errorTrace)) : ?>
            <h3>Error Trace</h3>
            <pre><?php echo $errorTrace; ?></pre>
        <?php endif; ?>
    </div>

</body>

</html>