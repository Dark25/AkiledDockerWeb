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
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile-dark.css" media="(prefers-color-scheme: dark)">
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

                    <!-- Hero Section -->
                    <div class="bento-item hero">
                        <div class="hero-banner" style="background-image: url('/assets/images/profile/background.png');"></div>
                        <div class="hero-content">
                            <div class="hero-avatar">
                                <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=l" alt="<?= filter(userHome('username')); ?>">
                            </div>
                            <div class="hero-info">
                                <div class="hero-badge-status">Online</div>
                                <h1 class="hero-username"><?= filter(userHome('username')); ?></h1>
                                <p class="hero-motto">“<?= filter(userHome('motto')); ?>”</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Card -->
                    <div class="bento-item stats">
                        <div class="bento-header">
                            <img src="/assets/images/user-space/credits.png" alt="stats">
                            <span>Balance Global</span>
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

                    <!-- Photos Card -->
                    <div class="bento-item photos">
                        <div class="bento-header">
                            <img src="/assets/images/collider/camera.png" alt="photos">
                            <span>Galería Reciente</span>
                        </div>
                        <div class="bento-body">
                            <?php include_once("get/profile/homePhotos.php"); ?>
                        </div>
                    </div>

                    <!-- Badges Card -->
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

                    <!-- Rooms Card -->
                    <div class="bento-item rooms">
                        <div class="bento-header">
                            <img src="/assets/images/collider/public-room.png" alt="rooms">
                            <span>Mis Creaciones</span>
                        </div>
                        <div class="bento-body-rooms">
                            <?php include_once("get/profile/homeRooms.php"); ?>
                        </div>
                    </div>

                    <!-- Social Card -->
                    <div class="bento-item social">
                        <div class="bento-header">
                            <img src="/assets/images/collider/feeds.png" alt="friends">
                            <span>Círculo Social</span>
                        </div>
                        <div class="social-tabs">
                            <div class="social-grid">
                                <?php include_once("get/profile/homeFriends.php"); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Groups Card -->
                    <div class="bento-item groups">
                         <div class="bento-header">
                            <img src="/assets/images/collider/users.png" alt="groups">
                            <span>Comunidades</span>
                        </div>
                        <div class="bento-body">
                            <div class="groups-flex">
                                <?php include_once("get/profile/homeGroups.php"); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Info Card -->
                    <div class="bento-item info-footer">
                        <p>Miembro oficial desde el <strong><?= date('d-m-Y', userHome('account_created')); ?></strong></p>
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
