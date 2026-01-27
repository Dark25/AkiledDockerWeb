<?php
$index_active = 'active';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang["DescHotel"]; ?> - <?= $lang["NameHotel"]; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="/assets/scripts/jquery.min.js"></script>
    <style>
        .error {
            background: rgba(217, 7, 7, .85);
            border-color: rgba(217, 7, 7, .94);
            color: #FFFFFF;
            text-align-last: center;
            padding: 5px;
            display: block;
        }
    </style>
</head>

<body class="container">
    <?php User::Login(); ?>
    <script src="/assets/scripts/page-load.js"></script>
    <div class="page-content">
        <?php include_once("auth/login.php"); ?>
        <?php include_once("includes/menu.php"); ?>
        <div class="page-content-collider">
            <div class="page-content-max-width" style="flex-direction: column;align-items: flex-start;">
                <?php include_once("get/getInfosIndex.php"); ?>
                <?php include_once("get/getPhotos.php"); ?>
            </div>
        </div>
        <?php include_once("includes/footer.php"); ?>
    </div>
    <script src="/assets/scripts/app.js" defer></script>
</body>

</html>