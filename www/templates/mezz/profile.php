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

        <div class="modern-profile-container">
            <div class="modern-profile-grid">

                <!-- Left: Hero Column -->
                <aside class="profile-side-column">
                    <div class="modern-card hero-card animate-fade-in">
                        <div class="card-hero-header">
                            <div class="avatar-glow-ring">
                                <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=l" alt="<?= filter(userHome('username')); ?>" class="main-avatar">
                            </div>
                        </div>
                        <div class="card-hero-body">
                            <h2 class="profile-name"><?= filter(userHome('username')); ?></h2>
                            <div class="profile-motto-bubble">
                                <p>"<?= filter(userHome('motto')); ?>"</p>
                            </div>

                            <div class="profile-meta">
                                <span class="meta-item join-date">Hotelero desde <?= date('M Y', userHome('account_created')); ?></span>
                            </div>
                        </div>

                        <div class="profile-purse-grid">
                            <div class="purse-box credits">
                                <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/credits.png'>
                                <div class="purse-info">
                                    <span class="purse-value"><?= number_format(userHome('credits')); ?></span>
                                    <span class="purse-label">Créditos</span>
                                </div>
                            </div>
                            <div class="purse-box planets">
                                <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/planeta.png'>
                                <div class="purse-info">
                                    <span class="purse-value"><?= number_format(userHome('activity_points')); ?></span>
                                    <span class="purse-label">Planetas</span>
                                </div>
                            </div>
                            <div class="purse-box diamonds">
                                <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/esmeralda.png'>
                                <div class="purse-info">
                                    <span class="purse-value"><?= number_format(userHome('vip_points')); ?></span>
                                    <span class="purse-label">Esmeraldas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Center: Content Column -->
                <main class="profile-main-column">
                    <!-- Badges Showcase -->
                    <div class="modern-card glass animate-slide-up">
                        <div class="card-header">
                            <i class="icon-badges"></i>
                            <h3>Mis Placas</h3>
                        </div>
                        <div class="card-body badges-display">
                            <?php include_once("get/profile/homeBadges.php"); ?>
                        </div>
                    </div>

                    <!-- Photos Gallery -->
                    <div class="modern-card glass animate-slide-up delay-1">
                        <div class="card-header">
                            <i class="icon-camera"></i>
                            <h3>Momentos</h3>
                        </div>
                        <div class="card-body photos-display">
                            <?php include_once("get/profile/homePhotos.php"); ?>
                        </div>
                    </div>
                </main>

                <!-- Right: Social Column -->
                <aside class="profile-info-column">
                    <!-- Rooms -->
                    <div class="modern-card glass animate-slide-up delay-2">
                        <div class="card-header">
                            <i class="icon-rooms"></i>
                            <h3>Salas</h3>
                        </div>
                        <div class="card-body rooms-display">
                            <?php include_once("get/profile/homeRooms.php"); ?>
                        </div>
                    </div>

                    <!-- Friends -->
                    <div class="modern-card glass animate-slide-up delay-3">
                        <div class="card-header">
                            <i class="icon-friends"></i>
                            <h3>Amigos</h3>
                        </div>
                        <div class="card-body friends-display">
                            <?php include_once("get/profile/homeFriends.php"); ?>
                        </div>
                    </div>

                    <!-- Groups -->
                    <div class="modern-card glass animate-slide-up delay-4">
                        <div class="card-header">
                            <i class="icon-groups"></i>
                            <h3>Grupos</h3>
                        </div>
                        <div class="card-body groups-display">
                            <?php include_once("get/profile/homeGroups.php"); ?>
                        </div>
                    </div>
                </aside>

            </div>

            <footer class="modern-profile-footer">
                <p>© <?= date('Y') ?> <?= $config['hotelName'] ?> Hotel - Todos los derechos reservados.</p>
            </footer>
        </div>

        <?php include_once('includes/footer.php'); ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="/assets/scripts/app.js"></script>
    </div>
</body>

</html>
