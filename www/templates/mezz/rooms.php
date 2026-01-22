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
                <!-- Hero Section -->
                <div class="rooms-hero">
                    <div class="rooms-hero-content">
                        <div class="rooms-hero-badge">COMUNIDAD</div>
                        <h1 class="rooms-hero-title"><?= $lang["RoomTitle"] ?></h1>
                        <p class="rooms-hero-subtitle"><?= $lang["RoomDesc"] ?></p>
                    </div>
                    <div class="rooms-hero-icon">
                        <i class="fas fa-door-open"></i>
                    </div>
                </div>

                <div class="page-content-max-width has-sidebar">
                    <div class="page-content-main-column">
                        <div class="rooms-grid">
                            <?php include_once('get/getRooms.php'); ?>
                        </div>
                    </div>

                    <div class="page-content-sidebar">
                        <?php include_once('includes/sidebar.php'); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>
