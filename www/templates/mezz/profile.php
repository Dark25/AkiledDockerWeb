<?php
$profile_active = 'active';
$menu = "me";

if (empty($_GET['user'])) {
    header("Location:/");
    exit;
}

$user_query = $dbh->prepare("SELECT * FROM users WHERE username = :name");
$user_query->bindParam(':name', $_GET['user']);
$user_query->execute();
if ($user_query->rowCount() == 0) {
    header("Location:/");
    exit;
}
$userData = $user_query->fetch();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app-dark.css" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile-dark.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= filter(userHome('username')); ?> @ <?= $config['hotelName'] ?></title>
</head>

<body class="profile-page-body">
    <script src="/assets/scripts/page-load.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <div class="profile-background-overlay"></div>

    <div class="page-container">
        <?php
        if (!isset($_SESSION['id'])) {
            include('auth/login.php');
        } else {
            include('auth/logged.php');
        }
        ?>

        <?php include_once("includes/menu.php"); ?>

        <div class="profile-main-wrapper">
            <div class="bento-grid">

                <!-- Hero Section: Identity -->
                <section class="bento-item hero-section animate-in">
                    <div class="hero-header">
                        <div class="avatar-container">
                            <div class="avatar-glow"></div>
                            <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=l" alt="<?= filter(userHome('username')); ?>" class="profile-avatar">
                        </div>
                    </div>
                    <div class="hero-body">
                        <div class="username-row">
                            <h2 class="username"><?= filter(userHome('username')); ?></h2>
                            <div class="status-indicator <?= userHome('online') ? 'online' : 'offline' ?>" title="<?= userHome('online') ? 'Conectado' : 'Desconectado' ?>"></div>
                        </div>
                        <p class="motto"><?= filter(userHome('motto')); ?></p>
                        <div class="user-meta">
                            <span class="join-date"><i class="far fa-calendar-alt"></i> Miembro desde <?= date('M Y', userHome('account_created')); ?></span>
                        </div>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-pill">
                            <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/credits.png' alt="cr">
                            <span><?= number_format(userHome('credits')); ?></span>
                        </div>
                        <div class="stat-pill">
                            <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/planeta.png' alt="pl">
                            <span><?= number_format(userHome('activity_points')); ?></span>
                        </div>
                        <div class="stat-pill">
                            <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/esmeralda.png' alt="es">
                            <span><?= number_format(userHome('vip_points')); ?></span>
                        </div>
                    </div>
                </section>

                <!-- Badges Section -->
                <section class="bento-item badges-section animate-in delay-1">
                    <div class="section-title">
                        <i class="fas fa-id-badge"></i> Mis Placas
                    </div>
                    <div class="section-content scrollable">
                        <?php include_once("get/profile/homeBadges.php"); ?>
                    </div>
                </section>

                <!-- Photos Section -->
                <section class="bento-item photos-section animate-in delay-2">
                    <div class="section-title">
                        <i class="fas fa-camera"></i> Fotos Recientes
                    </div>
                    <div class="section-content scrollable">
                        <?php include_once("get/profile/homePhotos.php"); ?>
                    </div>
                </section>

                <!-- Rooms Section -->
                <section class="bento-item rooms-section animate-in delay-3">
                    <div class="section-title">
                        <i class="fas fa-door-open"></i> Salas de <?= filter(userHome('username')); ?>
                    </div>
                    <div class="section-content scrollable">
                        <?php include_once("get/profile/homeRooms.php"); ?>
                    </div>
                </section>

                <!-- Friends Section -->
                <section class="bento-item friends-section animate-in delay-4">
                    <div class="section-title">
                        <i class="fas fa-users"></i> Amigos
                    </div>
                    <div class="section-content">
                        <?php include_once("get/profile/homeFriends.php"); ?>
                    </div>
                </section>

                <!-- Groups Section -->
                <section class="bento-item groups-section animate-in delay-5">
                    <div class="section-title">
                        <i class="fas fa-users-cog"></i> Grupos
                    </div>
                    <div class="section-content">
                        <?php include_once("get/profile/homeGroups.php"); ?>
                    </div>
                </section>

            </div>

            <footer class="profile-footer">
                <p>&copy; <?= date('Y') ?> <?= $config['hotelName'] ?>. Todos los derechos reservados.</p>
            </footer>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>
