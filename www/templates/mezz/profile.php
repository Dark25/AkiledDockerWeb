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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title><?= filter(userHome('username')); ?> @ <?= $config['hotelName'] ?></title>
</head>

<body class="profile-page-body">
    <script src="/assets/scripts/page-load.js"></script>

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
            <div class="solaris-grid">

                <!-- Hero Column -->
                <aside class="solaris-card hero-card animate-up">
                    <div class="hero-cover">
                        <div class="avatar-wrapper">
                            <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=l" alt="<?= filter(userHome('username')); ?>" class="profile-avatar">
                        </div>
                    </div>

                    <div class="hero-info">
                        <h2 class="hero-username"><?= filter(userHome('username')); ?></h2>
                        <span class="hero-motto">"<?= filter(userHome('motto')); ?>"</span>

                        <div class="hero-stats-grid">
                            <div class="hero-stat-item">
                                <div class="stat-info">
                                    <img src="/templates/<?= $config["skin"]; ?>/assets/images/user-space/credits.png" class="stat-icon">
                                    <span class="stat-label">Créditos</span>
                                </div>
                                <span class="stat-value"><?= number_format(userHome('credits')); ?></span>
                            </div>
                            <div class="hero-stat-item">
                                <div class="stat-info">
                                    <img src="/templates/<?= $config["skin"]; ?>/assets/images/user-space/planeta.png" class="stat-icon">
                                    <span class="stat-label">Planetas</span>
                                </div>
                                <span class="stat-value"><?= number_format(userHome('activity_points')); ?></span>
                            </div>
                            <div class="hero-stat-item">
                                <div class="stat-info">
                                    <img src="/templates/<?= $config["skin"]; ?>/assets/images/user-space/esmeralda.png" class="stat-icon">
                                    <span class="stat-label">Esmeraldas</span>
                                </div>
                                <span class="stat-value"><?= number_format(userHome('vip_points')); ?></span>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Middle Column: Badges & Photos -->
                <main class="center-column">
                    <!-- Badges -->
                    <section class="solaris-card animate-up delay-1" style="margin-bottom: 30px;">
                        <header class="section-header">
                            <div class="section-icon"><i class="fas fa-certificate"></i></div>
                            <h3 class="section-title">Colección de Placas</h3>
                        </header>
                        <div class="badges-list">
                            <?php include_once("get/profile/homeBadges.php"); ?>
                        </div>
                    </section>

                    <!-- Photos -->
                    <section class="solaris-card animate-up delay-2">
                        <header class="section-header">
                            <div class="section-icon"><i class="fas fa-camera-retro"></i></div>
                            <h3 class="section-title">Momentos Recientes</h3>
                        </header>
                        <div class="photos-list">
                            <?php include_once("get/profile/homePhotos.php"); ?>
                        </div>
                    </section>
                </main>

                <!-- Right Column: Rooms, Friends, Groups -->
                <aside class="right-column">
                    <!-- Rooms -->
                    <section class="solaris-card animate-up delay-1" style="margin-bottom: 30px;">
                        <header class="section-header">
                            <div class="section-icon"><i class="fas fa-door-open"></i></div>
                            <h3 class="section-title">Salas Propias</h3>
                        </header>
                        <div class="rooms-list">
                            <?php include_once("get/profile/homeRooms.php"); ?>
                        </div>
                    </section>

                    <!-- Social Bento (Friends + Groups) -->
                    <section class="solaris-card animate-up delay-2">
                        <header class="section-header">
                            <div class="section-icon"><i class="fas fa-share-nodes"></i></div>
                            <h3 class="section-title">Social</h3>
                        </header>
                        <div class="social-tabs" style="display: flex; gap: 20px; flex-direction: column;">
                            <div class="friends-mini">
                                <h4 style="font-size: 0.9rem; color: var(--solaris-text-muted); margin-bottom: 10px;">Amigos</h4>
                                <?php include_once("get/profile/homeFriends.php"); ?>
                            </div>
                            <div class="groups-mini">
                                <h4 style="font-size: 0.9rem; color: var(--solaris-text-muted); margin-bottom: 10px;">Grupos</h4>
                                <?php include_once("get/profile/homeGroups.php"); ?>
                            </div>
                        </div>
                    </section>
                </aside>

            </div>

            <footer style="text-align: center; margin-top: 60px; color: var(--solaris-text-muted); font-size: 0.9rem;">
                <p>&copy; <?= date('Y') ?> <?= $config['hotelName'] ?>. Rediseñado con <i class="fas fa-heart" style="color: var(--solaris-accent);"></i></p>
            </footer>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>
