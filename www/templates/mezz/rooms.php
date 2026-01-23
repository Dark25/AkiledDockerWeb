<?php
$rooms_active = 'active';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/rooms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $lang["TittleHader8"] ?></title>
</head>

<body class="container">
    <script src="/assets/scripts/page-load.js"></script>
    <div class="page-content">
        <?php
        if (!isset($_SESSION['id'])) {
            include('auth/login.php');
        } else {
            include('auth/logged.php');
        }
        ?>

        <?php include_once('includes/menu.php'); ?>

        <div class="page-content-collider" style="background-color: transparent;">
            <div class="page-content-max-width">

                <div class="rooms-container-flex">
                    <!-- Vertical Hero sidebar -->
                    <div class="rooms-hero-vertical">
                        <div class="rooms-hero-vertical-badge">COMUNIDAD</div>
                        <h1 class="rooms-hero-vertical-title"><?= $lang["RoomTitle"] ?></h1>
                        <p class="rooms-hero-vertical-subtitle"><?= $lang["RoomDesc"] ?></p>
                        <div class="rooms-hero-vertical-icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                    </div>

                    <!-- Main content and sidebar -->
                    <div class="rooms-content-wrapper">
                        <div class="rooms-main-grid">
                            <?php include_once('get/getRooms.php'); ?>
                        </div>

                        <div class="rooms-sidebar">
                            <?php include_once('includes/sidebar.php'); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>
