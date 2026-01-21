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
    <title><?= filter(userHome('username')); ?> @ <?= $config['hotelName'] ?></title>
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

        <div class="profile-dashboard">
            <!-- Dynamic Header Background -->
            <div class="profile-header-banner">
                <div class="banner-overlay"></div>
                <div class="banner-content">
                    <h2 class="banner-username"><?= filter(userHome('username')); ?></h2>
                    <p class="banner-motto"><?= filter(userHome('motto')); ?></p>
                </div>
            </div>

            <div class="profile-layout-container">
                <!-- Left Sidebar: Identity Card -->
                <aside class="profile-identity-sidebar">
                    <div class="identity-card">
                        <div class="identity-avatar-wrapper">
                            <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=l" alt="<?= filter(userHome('username')); ?>" class="identity-avatar-img">
                        </div>

                        <div class="identity-info">
                            <h3 class="identity-name"><?= filter(userHome('username')); ?></h3>
                            <span class="identity-status">Miembro del Hotel</span>
                        </div>

                        <div class="identity-stats">
                            <div class="id-stat">
                                <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/credits.png'>
                                <div class="id-stat-info">
                                    <span class="id-stat-value"><?= number_format(userHome('credits')); ?></span>
                                    <span class="id-stat-label">Créditos</span>
                                </div>
                            </div>
                            <div class="id-stat">
                                <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/planeta.png'>
                                <div class="id-stat-info">
                                    <span class="id-stat-value"><?= number_format(userHome('activity_points')); ?></span>
                                    <span class="id-stat-label">Planetas</span>
                                </div>
                            </div>
                            <div class="id-stat">
                                <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/esmeralda.png'>
                                <div class="id-stat-info">
                                    <span class="id-stat-value"><?= number_format(userHome('vip_points')); ?></span>
                                    <span class="id-stat-label">Esmeraldas</span>
                                </div>
                            </div>
                        </div>

                        <div class="identity-footer">
                            <p>Miembro desde <?= date('M Y', userHome('account_created')); ?></p>
                            <small>Última vez: <?= date('d/m/Y', userHome('last_online')); ?></small>
                        </div>
                    </div>
                </aside>

                <!-- Right Main Content: Feed -->
                <main class="profile-main-feed">
                    <!-- Badges Section -->
                    <section class="feed-section glass-card animate-slide-up">
                        <div class="section-header">
                            <img src="/assets/images/collider/feeds.png" alt="">
                            <h3>Colección de Placas</h3>
                        </div>
                        <div class="section-body">
                            <?php include_once("get/profile/homeBadges.php"); ?>
                        </div>
                    </section>

                    <div class="feed-row">
                        <!-- Rooms Section -->
                        <section class="feed-section glass-card animate-slide-up delay-1">
                            <div class="section-header">
                                <img src="/assets/images/collider/rooms.png" alt="">
                                <h3>Salas Recientes</h3>
                            </div>
                            <div class="section-body">
                                <?php include_once("get/profile/homeRooms.php"); ?>
                            </div>
                        </section>

                        <!-- Groups Section -->
                        <section class="feed-section glass-card animate-slide-up delay-2">
                            <div class="section-header">
                                <img src="/assets/images/collider/users.png" alt="">
                                <h3>Grupos</h3>
                            </div>
                            <div class="section-body">
                                <?php include_once("get/profile/homeGroups.php"); ?>
                            </div>
                        </section>
                    </div>

                    <!-- Friends Section -->
                    <section class="feed-section glass-card animate-slide-up delay-3">
                        <div class="section-header">
                            <img src="/assets/images/collider/users.png" alt="">
                            <h3>Círculo de Amigos</h3>
                        </div>
                        <div class="section-body">
                            <?php include_once("get/profile/homeFriends.php"); ?>
                        </div>
                    </section>

                    <!-- Photos Section -->
                    <section class="feed-section glass-card animate-slide-up delay-4">
                        <div class="section-header">
                            <img src="/assets/images/collider/camera.png" alt="">
                            <h3>Galería de Fotos</h3>
                        </div>
                        <div class="section-body photos-grid">
                            <?php include_once("get/profile/homePhotos.php"); ?>
                        </div>
                    </section>
                </main>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="/assets/scripts/app.js"></script>
    </div>
</body>

</html>
