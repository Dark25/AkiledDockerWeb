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

                <!-- Left Column: User Identity -->
                <aside class="profile-left-column">
                    <div class="modern-card identity-card animate-fade-in">
                        <div class="card-hero-header">
                            <div class="avatar-glow-ring">
                                <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=l" alt="<?= filter(userHome('username')); ?>" class="main-avatar">
                            </div>
                        </div>
                        <div class="card-hero-body">
                            <h2 class="profile-name"><?= filter(userHome('username')); ?></h2>
                            <div class="profile-motto-wrap">
                                <p class="profile-motto">"<?= filter(userHome('motto')); ?>"</p>
                            </div>
                            <div class="profile-join-badge">
                                Hotelero desde <?= date('M Y', userHome('account_created')); ?>
                            </div>
                        </div>

                        <div class="profile-purse-section">
                            <div class="purse-row credits">
                                <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/credits.png' class="purse-icon">
                                <div class="purse-data">
                                    <span class="purse-val"><?= number_format(userHome('credits')); ?></span>
                                    <span class="purse-lbl">Créditos</span>
                                </div>
                            </div>
                            <div class="purse-row planets">
                                <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/planeta.png' class="purse-icon">
                                <div class="purse-data">
                                    <span class="purse-val"><?= number_format(userHome('activity_points')); ?></span>
                                    <span class="purse-lbl">Planetas</span>
                                </div>
                            </div>
                            <div class="purse-row emeralds">
                                <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/esmeralda.png' class="purse-icon">
                                <div class="purse-data">
                                    <span class="purse-val"><?= number_format(userHome('vip_points')); ?></span>
                                    <span class="purse-lbl">Esmeraldas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Center Column: Content Feed -->
                <main class="profile-center-column">
                    <!-- Badges -->
                    <div class="modern-card section-card animate-slide-up">
                        <div class="section-title-bar">
                            <img src="/assets/images/collider/feeds.png" class="section-icon">
                            <h3>Mis Placas</h3>
                        </div>
                        <div class="section-content badges-area">
                            <?php include_once("get/profile/homeBadges.php"); ?>
                        </div>
                    </div>

                    <!-- Photos -->
                    <div class="modern-card section-card animate-slide-up delay-1">
                        <div class="section-title-bar">
                            <img src="/assets/images/collider/camera.png" class="section-icon">
                            <h3>Momentos</h3>
                        </div>
                        <div class="section-content photos-area">
                            <?php include_once("get/profile/homePhotos.php"); ?>
                        </div>
                    </div>
                </main>

                <!-- Right Column: Social -->
                <aside class="profile-right-column">
                    <!-- Rooms -->
                    <div class="modern-card social-card animate-slide-up delay-2">
                        <div class="section-title-bar">
                            <img src="/assets/images/collider/rooms.png" class="section-icon">
                            <h3>Salas</h3>
                        </div>
                        <div class="section-content rooms-area">
                            <?php include_once("get/profile/homeRooms.php"); ?>
                        </div>
                    </div>

                    <!-- Friends -->
                    <div class="modern-card social-card animate-slide-up delay-3">
                        <div class="section-title-bar">
                            <img src="/assets/images/collider/users.png" class="section-icon">
                            <h3>Amigos</h3>
                        </div>
                        <div class="section-content friends-area">
                            <?php include_once("get/profile/homeFriends.php"); ?>
                        </div>
                    </div>

                    <!-- Groups -->
                    <div class="modern-card social-card animate-slide-up delay-4">
                        <div class="section-title-bar">
                            <img src="/assets/images/collider/groups.png" class="section-icon">
                            <h3>Grupos</h3>
                        </div>
                        <div class="section-content groups-area">
                            <?php include_once("get/profile/homeGroups.php"); ?>
                        </div>
                    </div>
                </aside>

            </div>

            <footer class="profile-simple-footer">
                <p>© <?= date('Y') ?> <?= $config['hotelName'] ?> Hotel. Rediseñado para una mejor experiencia.</p>
            </footer>
        </div>

        <?php include_once('includes/footer.php'); ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="/assets/scripts/app.js"></script>
    </div>
</body>

</html>
