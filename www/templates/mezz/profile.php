<?php
$profile_active = 'active';
$menu = "me";

if (empty($_GET['user'])) {
    header("Location:/");
    exit();
}

$news = $dbh->prepare("SELECT * FROM users WHERE username = :name");
$news->bindParam(':name', $_GET['user']);
$news->execute();
if ($news->RowCount() == 0) {
    header("Location:/");
    exit();
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app-dark.css" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Perfil de: <?= filter(userHome('username')); ?></title>
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

        <?php include_once("includes/menu.php"); ?>

        <div class="page-content-collider" style="background-color: transparent;">
            <div class="page-content-max-width">

                <div class="profile-bento-grid">

                    <!-- 1. Hero Section -->
                    <div class="bento-item hero">
                        <div class="hero-banner" style="background-image: url('/assets/images/profile/background.png');"></div>
                        <div class="hero-content">
                            <div class="hero-avatar">
                                <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=l" alt="<?= filter(userHome('username')); ?>">
                            </div>
                            <div class="hero-info">
                                <h1 class="hero-username"><?= filter(userHome('username')); ?></h1>
                                <p class="hero-motto"><?= filter(userHome('motto')); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Stats Card (Span 1) -->
                    <div class="bento-item stats">
                        <div class="bento-header">
                            <img src="/assets/images/user-space/credits.png" alt="stats">
                            <span>Mis Riquezas</span>
                        </div>
                        <div class="stats-list">
                            <div class="stat-row">
                                <img src='/assets/images/user-space/credits.png'>
                                <span class="stat-name">Créditos</span>
                                <span class="stat-count"><?= number_format(userHome('credits')); ?></span>
                            </div>
                            <div class="stat-row">
                                <img src='/assets/images/user-space/planeta.png'>
                                <span class="stat-name">Planetas</span>
                                <span class="stat-count"><?= userHome('activity_points'); ?></span>
                            </div>
                            <div class="stat-row">
                                <img src='/assets/images/user-space/esmeralda.png'>
                                <span class="stat-name">Esmeraldas</span>
                                <span class="stat-count"><?= userHome('vip_points'); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Photos Card (Span 2) -->
                    <div class="bento-item photos">
                        <div class="bento-header">
                            <img src="/assets/images/collider/camera.png" alt="photos">
                            <span>Galería de Momentos</span>
                        </div>
                        <div class="bento-body">
                            <?php include_once("get/profile/homePhotos.php"); ?>
                        </div>
                    </div>

                    <!-- 4. Badges Card (Span 3) -->
                    <div class="bento-item badges">
                        <div class="bento-header">
                            <img src="/assets/images/highscores/trophy-gold.png" alt="badges">
                            <span>Colección de Placas</span>
                        </div>
                        <div class="bento-body">
                            <div class="badges-flex">
                                <?php include_once("get/profile/homeBadges.php"); ?>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Social Card (Span 2) -->
                    <div class="bento-item social">
                        <div class="bento-header">
                            <img src="/assets/images/collider/feeds.png" alt="friends">
                            <span>Círculo de Amigos</span>
                        </div>
                        <div class="social-grid">
                            <?php include_once("get/profile/homeFriends.php"); ?>
                        </div>
                    </div>

                    <!-- 6. Groups Card (Span 1) -->
                    <div class="bento-item groups">
                         <div class="bento-header">
                            <img src="/assets/images/collider/users.png" alt="groups">
                            <span>Grupos</span>
                        </div>
                        <div class="groups-flex">
                            <?php include_once("get/profile/homeGroups.php"); ?>
                        </div>
                    </div>

                    <!-- 7. Rooms Card (Span 3) -->
                    <div class="bento-item rooms">
                        <div class="bento-header">
                            <img src="/assets/images/collider/public-room.png" alt="rooms">
                            <span>Mis Creaciones Reales</span>
                        </div>
                        <div class="bento-body-rooms">
                            <?php include_once("get/profile/homeRooms.php"); ?>
                        </div>
                    </div>

                    <!-- 8. Footer Info Card (Span 3) -->
                    <div class="bento-item info-footer">
                        <p>Hionix oficial desde el <?= date('d-m-Y', userHome('account_created')); ?></p>
                    </div>

                </div>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="/assets/scripts/app.js"></script>
    </div>
</body>

</html>
