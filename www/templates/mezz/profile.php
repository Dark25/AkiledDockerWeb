<?php
$profile_active = 'active';
$menu = "me";

if (empty($_GET['user'])) {
    header("Location:/");
}

$news = $dbh->prepare("SELECT * FROM users WHERE username = :name");
$news->bindParam(':name', $_GET['user']);
$news->execute();
if ($news->RowCount() == 0) {
    header("Location:/");
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app-dark.css" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile-dark.css" media="(prefers-color-scheme: dark)">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= filter(userHome('username')); ?> - <?= $config['hotelName'] ?> Perfil</title>
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

        <div class="habbo-profile-wrapper">
            <!-- Header: Room Preview -->
            <div class="habbo-profile-header">
                <div class="habbo-room-scene">
                    <div class="habbo-avatar-showcase">
                        <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=l" alt="<?= filter(userHome('username')); ?>" class="avatar-pixel">
                    </div>
                    <div class="habbo-bubble-motto">
                        <div class="bubble-content">
                            <?= filter(userHome('motto')); ?>
                        </div>
                    </div>
                </div>
                <div class="habbo-user-info-bar">
                    <div class="habbo-user-main">
                        <h1 class="habbo-username"><?= filter(userHome('username')); ?></h1>
                        <span class="habbo-joined">Miembro desde: <?= date('d/m/Y', userHome('account_created')); ?></span>
                    </div>
                    <div class="habbo-purse-display">
                        <div class="purse-item" title="Créditos">
                            <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/credits.png'>
                            <span><?= number_format(userHome('credits')); ?></span>
                        </div>
                        <div class="purse-item" title="Planetas">
                            <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/planeta.png'>
                            <span><?= number_format(userHome('activity_points')); ?></span>
                        </div>
                        <div class="purse-item" title="Esmeraldas">
                            <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/esmeralda.png'>
                            <span><?= number_format(userHome('vip_points')); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="habbo-profile-grid">
                <!-- Column 1 -->
                <div class="habbo-column">
                    <!-- Badges Widget -->
                    <div class="habbo-widget">
                        <div class="widget-header">
                            <img src="/assets/images/collider/feeds.png" alt="">
                            <span>Mis Placas</span>
                        </div>
                        <div class="widget-content badges-widget">
                            <?php include_once("get/profile/homeBadges.php"); ?>
                        </div>
                    </div>

                    <!-- Friends Widget -->
                    <div class="habbo-widget">
                        <div class="widget-header">
                            <img src="/assets/images/collider/users.png" alt="">
                            <span>Amigos</span>
                        </div>
                        <div class="widget-content friends-widget">
                            <?php include_once("get/profile/homeFriends.php"); ?>
                        </div>
                    </div>
                </div>

                <!-- Column 2 -->
                <div class="habbo-column">
                    <!-- Rooms Widget -->
                    <div class="habbo-widget">
                        <div class="widget-header">
                            <img src="/assets/images/collider/rooms.png" alt="">
                            <span>Mis Salas</span>
                        </div>
                        <div class="widget-content rooms-widget">
                            <?php include_once("get/profile/homeRooms.php"); ?>
                        </div>
                    </div>

                    <!-- Groups Widget -->
                    <div class="habbo-widget">
                        <div class="widget-header">
                            <img src="/assets/images/collider/groups.png" alt="">
                            <span>Grupos</span>
                        </div>
                        <div class="widget-content groups-widget">
                            <?php include_once("get/profile/homeGroups.php"); ?>
                        </div>
                    </div>
                </div>

                <!-- Column 3 (Photos - Full Width below on mobile) -->
                <div class="habbo-column full-width">
                    <div class="habbo-widget">
                        <div class="widget-header">
                            <img src="/assets/images/collider/camera.png" alt="">
                            <span>Galería de Fotos</span>
                        </div>
                        <div class="widget-content photos-widget">
                            <?php include_once("get/profile/homePhotos.php"); ?>
                        </div>
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
