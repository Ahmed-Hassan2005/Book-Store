<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" href="<?= asset('imgs/logo.png') ?>">

    <link rel="stylesheet" href="<?= asset('css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/global.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/home/index.css') ?>">
</head>

<body>

    <?php include __DIR__ . "/../component/Nav.php"; ?>

    <?php include __DIR__ . "/carousel.php"; ?>

    <!-------------------------------------------- JS ------------------------------------------->

    <script src="<?= asset('js/bootstrap.js') ?>"></script>
    <script src="<?= asset('js/jquery.js') ?>"></script>
    <script src="<?= asset('js/global.js') ?>"></script>
    <script src="<?= asset('js/home/index.js') ?>"></script>

</body>

</html>