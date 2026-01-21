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
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile-dark.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= filter(userHome('username')); ?> @ <?= $config['hotelName'] ?></title>
</head>

<body class="container profile-page-body">
    <script src="/assets/scripts/page-load.js"></script>

    <!-- Cosmic Background Overlay -->
    <div class="cosmic-overlay"></div>

    <div class="page-content">

        <?php
        if (!isset($_SESSION['id'])) {
            include('auth/login.php');
        } else {
            include('auth/logged.php');
        }
        ?>

        <?php include_once("includes/menu.php"); ?>

        <div class="cosmic-profile-wrapper">
            <div class="cosmic-profile-grid">

                <!-- Left Column: Identity & Stats -->
                <aside class="profile-col-left">
                    <div class="cosmic-card identity-card animate-fade-in">
                        <div class="identity-header">
                            <div class="identity-avatar-box">
                                <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=l" alt="<?= filter(userHome('username')); ?>" class="cosmic-avatar">
                            </div>
                        </div>

                        <div class="identity-info">
                            <h2 class="cosmic-username"><?= filter(userHome('username')); ?></h2>
                            <p class="cosmic-motto">"<?= filter(userHome('motto')); ?>"</p>
                            <span class="cosmic-join-date">Hotelero desde <?= date('M Y', userHome('account_created')); ?></span>
                        </div>

                        <div class="cosmic-stats">
                            <div class="stat-box stat-credits">
                                <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/credits.png' class="stat-icon">
                                <div class="stat-details">
                                    <span class="stat-value"><?= number_format(userHome('credits')); ?></span>
                                    <span class="stat-label">CRÉDITOS</span>
                                </div>
                            </div>
                            <div class="stat-box stat-planets">
                                <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/planeta.png' class="stat-icon">
                                <div class="stat-details">
                                    <span class="stat-value"><?= number_format(userHome('activity_points')); ?></span>
                                    <span class="stat-label">PLANETAS</span>
                                </div>
                            </div>
                            <div class="stat-box stat-emeralds">
                                <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/esmeralda.png' class="stat-icon">
                                <div class="stat-details">
                                    <span class="stat-value"><?= number_format(userHome('vip_points')); ?></span>
                                    <span class="stat-label">ESMERALDAS</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Piles of gold/gems decoration at the bottom of left column -->
                    <div class="decoration-gems animate-fade-in delay-2">
                        <img src="https://i.imgur.com/0Pz5n3s.png" alt="gems" class="gem-pile">
                    </div>
                </aside>

                <!-- Center Column: Badges, Photos, Rocket -->
                <main class="profile-col-center">
                    <!-- Badges -->
                    <div class="cosmic-card section-card animate-slide-up">
                        <div class="cosmic-card-header">
                            <h3>Mis Placas</h3>
                        </div>
                        <div class="cosmic-card-body badges-container">
                            <?php include_once("get/profile/homeBadges.php"); ?>
                        </div>
                    </div>

                    <!-- Photos -->
                    <div class="cosmic-card section-card animate-slide-up delay-1">
                        <div class="cosmic-card-header">
                            <h3>Fotos</h3>
                        </div>
                        <div class="cosmic-card-body photos-container">
                            <?php include_once("get/profile/homePhotos.php"); ?>
                        </div>
                    </div>

                    <!-- Rocket Decoration -->
                    <div class="decoration-rocket animate-launch">
                        <img src="https://i.imgur.com/vH9Z3lO.png" alt="rocket" class="rocket-img">
                    </div>
                </main>

                <!-- Right Column: Rooms, Friends, Groups -->
                <aside class="profile-col-right">
                    <!-- Rooms -->
                    <div class="cosmic-card section-card animate-slide-up delay-2">
                        <div class="cosmic-card-header">
                            <h3>Salas</h3>
                        </div>
                        <div class="cosmic-card-body rooms-container">
                            <?php include_once("get/profile/homeRooms.php"); ?>
                        </div>
                    </div>

                    <!-- Friends -->
                    <div class="cosmic-card section-card animate-slide-up delay-3">
                        <div class="cosmic-card-header">
                            <h3>Amigos</h3>
                        </div>
                        <div class="cosmic-card-body friends-container">
                            <?php include_once("get/profile/homeFriends.php"); ?>
                        </div>
                    </div>

                    <!-- Groups -->
                    <div class="cosmic-card section-card animate-slide-up delay-4">
                        <div class="cosmic-card-header">
                            <h3>Grupos</h3>
                        </div>
                        <div class="cosmic-card-body groups-container">
                            <?php include_once("get/profile/homeGroups.php"); ?>
                        </div>
                    </div>
                </aside>

            </div>

            <footer class="cosmic-footer">
                <p>© <?= date('Y') ?> <?= $config['hotelName'] ?> Hotel.</p>
            </footer>
        </div>

        <?php include_once('includes/footer.php'); ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="/assets/scripts/app.js"></script>
    </div>
</body>

</html>
