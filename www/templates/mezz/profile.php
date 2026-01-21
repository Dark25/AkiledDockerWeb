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
            <div class="page-content-max-width has-sidebar">
                <div class="page-content-main-column">

                    <!-- Profile Header Card -->
                    <div class="profile-header-card">
                        <div class="profile-header-banner" style="background-image: url('/assets/images/profile/background.png');"></div>
                        <div class="profile-header-content">
                            <div class="profile-avatar-wrapper">
                                <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=l" alt="<?= filter(userHome('username')); ?>" class="profile-avatar-img">
                            </div>
                            <div class="profile-header-info">
                                <h1 class="profile-username"><?= filter(userHome('username')); ?></h1>
                                <p class="profile-motto"><?= filter(userHome('motto')); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- User Photos -->
                    <div class="profile-section-card">
                        <div class="profile-section-header">
                            <img src="/assets/images/collider/camera.png" class="section-icon">
                            <h3>Mis Momentos</h3>
                        </div>
                        <div class="profile-section-body">
                            <?php include_once("get/profile/homePhotos.php"); ?>
                        </div>
                    </div>

                    <!-- User Rooms -->
                    <div class="profile-section-card">
                        <div class="profile-section-header">
                            <img src="/assets/images/collider/public-room.png" class="section-icon">
                            <h3>Mis Salas</h3>
                        </div>
                        <div class="profile-section-body">
                            <?php include_once("get/profile/homeRooms.php"); ?>
                        </div>
                    </div>

                </div>

                <div class="page-content-sidebar">

                    <!-- Stats Widget -->
                    <div class="sidebar-widget user-stats-card">
                        <div class="widget-title-modern">
                            <img src="/assets/images/user-space/credits.png">
                            <h3>Estadísticas</h3>
                        </div>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <img src='/assets/images/user-space/credits.png'>
                                <div class="stat-info">
                                    <span class="stat-value"><?= number_format(userHome('credits')); ?></span>
                                    <span class="stat-label">Monedas</span>
                                </div>
                            </div>
                            <div class="stat-item">
                                <img src='/assets/images/user-space/planeta.png'>
                                <div class="stat-info">
                                    <span class="stat-value"><?= userHome('activity_points'); ?></span>
                                    <span class="stat-label">Planetas</span>
                                </div>
                            </div>
                            <div class="stat-item">
                                <img src='/assets/images/user-space/esmeralda.png'>
                                <div class="stat-info">
                                    <span class="stat-value"><?= userHome('vip_points'); ?></span>
                                    <span class="stat-label">Esmeraldas</span>
                                </div>
                            </div>
                        </div>
                        <div class="profile-joined-date">
                            Miembro desde el <?= date('d-m-Y', userHome('account_created')); ?>
                        </div>
                    </div>

                    <!-- Badges Widget -->
                    <div class="sidebar-widget profile-badges-card">
                        <div class="widget-title-modern">
                            <img src="/assets/images/highscores/trophy-gold.png">
                            <h3>Placas Reales</h3>
                        </div>
                        <div class="profile-badges-grid">
                            <?php include_once("get/profile/homeBadges.php"); ?>
                        </div>
                    </div>

                    <!-- Groups Widget -->
                    <div class="sidebar-widget profile-groups-card">
                        <div class="widget-title-modern">
                            <img src="/assets/images/collider/users.png">
                            <h3>Mis Grupos</h3>
                        </div>
                        <div class="profile-groups-grid">
                            <?php include_once("get/profile/homeGroups.php"); ?>
                        </div>
                    </div>

                    <!-- Friends Widget -->
                    <div class="sidebar-widget profile-friends-card">
                        <div class="widget-title-modern">
                            <img src="/assets/images/collider/feeds.png">
                            <h3>Mis Amigos</h3>
                        </div>
                        <div class="profile-friends-grid">
                            <?php include_once("get/profile/homeFriends.php"); ?>
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
