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
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
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

        <div class="profile-container">
            <!-- Header Section -->
            <div class="profile-header">
                <div class="profile-cover"></div>
                <div class="profile-info">
                    <div class="profile-avatar-wrapper">
                        <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=l"
                             alt="<?= filter(userHome('username')); ?>"
                             class="profile-avatar-img">
                    </div>
                    <div class="profile-details">
                        <h1 class="profile-username"><?= filter(userHome('username')); ?></h1>
                        <p class="profile-motto"><?= filter(userHome('motto')); ?></p>
                    </div>
                </div>

                <div class="profile-stats-row">
                    <div class="stat-card">
                        <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/credits.png'>
                        <div class="stat-info">
                            <span class="stat-value"><?= number_format(userHome('credits')); ?></span>
                            <span class="stat-label">Créditos</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/planeta.png'>
                        <div class="stat-info">
                            <span class="stat-value"><?= number_format(userHome('activity_points')); ?></span>
                            <span class="stat-label">Planetas</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/esmeralda.png'>
                        <div class="stat-info">
                            <span class="stat-value"><?= number_format(userHome('vip_points')); ?></span>
                            <span class="stat-label">Esmeraldas</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-content-grid">
                <!-- Left Column -->
                <div class="profile-main-content">
                    <div class="profile-section">
                        <div class="section-header">
                            <h2 class="section-title">Placas Recientes</h2>
                        </div>
                        <?php include_once("get/profile/homeBadges.php"); ?>
                    </div>

                    <div class="profile-section">
                        <div class="section-header">
                            <h2 class="section-title">Grupos</h2>
                        </div>
                        <?php include_once("get/profile/homeGroups.php"); ?>
                    </div>

                    <div class="profile-section">
                        <div class="section-header">
                            <h2 class="section-title">Galería de Fotos</h2>
                        </div>
                        <div class="photos-grid">
                            <?php include_once("get/profile/homePhotos.php"); ?>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="profile-sidebar">
                    <div class="profile-section">
                        <div class="section-header">
                            <h2 class="section-title">Amigos</h2>
                        </div>
                        <?php include_once("get/profile/homeFriends.php"); ?>
                    </div>

                    <div class="profile-section">
                        <div class="section-header">
                            <h2 class="section-title">Habitaciones</h2>
                        </div>
                        <?php include_once("get/profile/homeRooms.php"); ?>
                    </div>
                </div>
            </div>

            <div class="profile-footer-info">
                Unido a <?= $config['hotelName'] ?> en <?= date('d-m-Y', userHome('account_created')); ?>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="/assets/scripts/app.js"></script>
    </div>
</body>

</html>
