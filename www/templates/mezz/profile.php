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
    <title>Perfil de: <?= userHome('username'); ?></title>
</head>

<body class="container profile-page-active">
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

        <div class="mezz-profile-wrapper">
            <!-- Glassmorphism Profile Header -->
            <div class="mezz-profile-header">
                <div class="mezz-profile-cover">
                    <div class="mezz-profile-overlay"></div>
                </div>

                <div class="mezz-profile-main-info">
                    <div class="mezz-profile-avatar">
                        <div class="mezz-avatar-circle">
                            <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=m"
                                 alt="<?= filter(userHome('username')); ?>">
                        </div>
                        <div class="mezz-online-status <?php echo (userHome('online') == '1' ? 'online' : 'offline'); ?>"></div>
                    </div>

                    <div class="mezz-profile-text">
                        <h1 class="mezz-username"><?= filter(userHome('username')); ?></h1>
                        <div class="mezz-motto-bubble">
                            <p class="mezz-motto"><?= filter(userHome('motto')); ?></p>
                        </div>
                    </div>

                    <div class="mezz-profile-actions">
                        <div class="mezz-join-date">
                            <span>Miembro desde</span>
                            <strong><?= date('M Y', userHome('account_created')); ?></strong>
                        </div>
                    </div>
                </div>

                <div class="mezz-profile-stats">
                    <div class="mezz-stat-item">
                        <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/credits.png'>
                        <div class="mezz-stat-details">
                            <span class="mezz-stat-value"><?= number_format(userHome('credits')); ?></span>
                            <span class="mezz-stat-label">Créditos</span>
                        </div>
                    </div>
                    <div class="mezz-stat-item">
                        <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/planeta.png'>
                        <div class="mezz-stat-details">
                            <span class="mezz-stat-value"><?= number_format(userHome('activity_points')); ?></span>
                            <span class="mezz-stat-label">Planetas</span>
                        </div>
                    </div>
                    <div class="mezz-stat-item">
                        <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/esmeralda.png'>
                        <div class="mezz-stat-details">
                            <span class="mezz-stat-value"><?= number_format(userHome('vip_points')); ?></span>
                            <span class="mezz-stat-label">Esmeraldas</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mezz-profile-grid">
                <!-- Main Content -->
                <div class="mezz-profile-column-main">
                    <!-- Badges -->
                    <div class="mezz-card">
                        <div class="mezz-card-header">
                            <i class="mezz-icon-badge"></i>
                            <h2 class="mezz-card-title">Colección de Placas</h2>
                        </div>
                        <div class="mezz-card-content p-badges">
                            <?php include_once("get/profile/homeBadges.php"); ?>
                        </div>
                    </div>

                    <!-- Groups -->
                    <div class="mezz-card">
                        <div class="mezz-card-header">
                            <i class="mezz-icon-group"></i>
                            <h2 class="mezz-card-title">Grupos</h2>
                        </div>
                        <div class="mezz-card-content p-groups">
                            <?php include_once("get/profile/homeGroups.php"); ?>
                        </div>
                    </div>

                    <!-- Photos -->
                    <div class="mezz-card">
                        <div class="mezz-card-header">
                            <i class="mezz-icon-camera"></i>
                            <h2 class="mezz-card-title">Galería de Fotos</h2>
                        </div>
                        <div class="mezz-card-content p-photos">
                            <div class="mezz-photos-container">
                                <?php include_once("get/profile/homePhotos.php"); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Content -->
                <div class="mezz-profile-column-side">
                    <!-- Friends -->
                    <div class="mezz-card">
                        <div class="mezz-card-header">
                            <i class="mezz-icon-friends"></i>
                            <h2 class="mezz-card-title">Amigos</h2>
                        </div>
                        <div class="mezz-card-content p-friends">
                            <?php include_once("get/profile/homeFriends.php"); ?>
                        </div>
                    </div>

                    <!-- Rooms -->
                    <div class="mezz-card">
                        <div class="mezz-card-header">
                            <i class="mezz-icon-room"></i>
                            <h2 class="mezz-card-title">Habitaciones</h2>
                        </div>
                        <div class="mezz-card-content p-rooms">
                            <?php include_once("get/profile/homeRooms.php"); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mezz-profile-footer">
                <p>Estás viendo el perfil de <strong><?= filter(userHome('username')); ?></strong> en <?= $config['hotelName'] ?></p>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="/assets/scripts/app.js"></script>
    </div>
</body>

</html>
