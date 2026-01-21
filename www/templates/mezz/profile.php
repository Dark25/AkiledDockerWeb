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
    <title>Perfil de: <?= userHome('username'); ?></title>
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
            <div class="profile-container">
                <div class="bento-grid">
                    <!-- Hero Card -->
                    <div class="bento-item hero">
                        <div class="hero-avatar">
                            <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=l" alt="<?= filter(userHome('username')); ?>">
                        </div>
                        <div class="hero-info">
                            <p>Hola, mi nombre es</p>
                            <h1><?= filter(userHome('username')); ?></h1>
                            <p>"<?= filter(userHome('motto')); ?>"</p>
                        </div>
                    </div>

                    <!-- Stats Card -->
                    <div class="bento-item stats">
                        <div class="stat-box">
                            <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/credits.png' alt="Credits">
                            <span class="stat-value"><?= filter(userHome('credits')); ?></span>
                            <span class="stat-label">Créditos</span>
                        </div>
                        <div class="stat-box">
                            <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/planeta.png' alt="Duckets">
                            <span class="stat-value"><?= userHome('activity_points'); ?></span>
                            <span class="stat-label">Planetas</span>
                        </div>
                        <div class="stat-box">
                            <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/esmeralda.png' alt="Diamonds">
                            <span class="stat-value"><?= userHome('vip_points'); ?></span>
                            <span class="stat-label">Esmeraldas</span>
                        </div>
                    </div>

                    <!-- Badges Card -->
                    <div class="bento-item badges">
                        <h3 class="bento-title">
                            <img src="/assets/images/collider/feeds.png" alt="">
                            Placas
                        </h3>
                        <?php include_once("get/profile/homeBadges.php"); ?>
                    </div>

                    <!-- Groups Card -->
                    <div class="bento-item groups" style="grid-column: span 2;">
                        <h3 class="bento-title">
                            <img src="/assets/images/collider/users.png" alt="">
                            Grupos
                        </h3>
                        <?php include_once("get/profile/homeGroups.php"); ?>
                    </div>

                    <!-- Rooms Card -->
                    <div class="bento-item rooms">
                        <h3 class="bento-title">
                            <img src="/assets/images/collider/public-room.png" alt="">
                            Salas
                        </h3>
                        <?php include_once("get/profile/homeRooms.php"); ?>
                    </div>

                    <!-- Friends Card -->
                    <div class="bento-item friends">
                        <h3 class="bento-title">
                            <img src="/assets/images/collider/users.png" alt="">
                            Amigos
                        </h3>
                        <?php include_once("get/profile/homeFriends.php"); ?>
                    </div>

                    <!-- Photos Card -->
                    <div class="bento-item photos">
                        <h3 class="bento-title">
                            <img src="/assets/images/collider/feeds.png" alt="">
                            Fotos
                        </h3>
                        <?php include_once("get/profile/homePhotos.php"); ?>
                    </div>

                    <!-- Footer -->
                    <div class="profile-footer">
                        Unido a <?= $config['hotelName'] ?> el <?= date('d-m-Y', userHome('account_created')); ?>
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