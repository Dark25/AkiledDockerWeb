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
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title><?= filter(userHome('username')); ?> @ <?= $config['hotelName'] ?></title>
</head>

<body class="profile-page-body">
    <script src="/assets/scripts/page-load.js"></script>

    <div class="profile-mesh-bg"></div>

    <div class="page-container">
        <?php
        if (!isset($_SESSION['id'])) {
            include('auth/login.php');
        } else {
            include('auth/logged.php');
        }
        ?>

        <?php include_once("includes/menu.php"); ?>

        <div class="profile-content-container">
            <!-- Profile Header Card -->
            <div class="profile-header-card animate-fade-in">
                <div class="header-banner"></div>
                <div class="header-main-info">
                    <div class="avatar-container">
                        <div class="avatar-ring"></div>
                        <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=2&gesture=sml&action=wav&size=l" alt="<?= filter(userHome('username')); ?>" class="profile-avatar-img">
                    </div>
                    <div class="user-text-info">
                        <h1 class="user-name-display"><?= filter(userHome('username')); ?></h1>
                        <p class="user-motto-display"><?= filter(userHome('motto')); ?></p>
                        <div class="user-badges-mini">
                             <?php if($userData['online'] == 1): ?>
                                <span class="status-badge online">En línea</span>
                             <?php else: ?>
                                <span class="status-badge offline">Desconectado</span>
                             <?php endif; ?>
                        </div>
                    </div>
                    <div class="header-quick-stats">
                        <div class="q-stat">
                            <span class="q-val"><?= number_format(userHome('credits')); ?></span>
                            <span class="q-lab">Créditos</span>
                        </div>
                        <div class="q-stat">
                            <span class="q-val"><?= number_format(userHome('activity_points')); ?></span>
                            <span class="q-lab">Planetas</span>
                        </div>
                        <div class="q-stat">
                            <span class="q-val"><?= number_format(userHome('vip_points')); ?></span>
                            <span class="q-lab">Esmeraldas</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-grid-layout">
                <!-- Left Sidebar -->
                <div class="profile-grid-aside">
                    <!-- Statistics Card -->
                    <div class="card-modern animate-fade-in delay-1">
                        <div class="card-header">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Información</span>
                        </div>
                        <div class="card-body">
                            <div class="stat-row">
                                <span class="stat-name">Miembro desde</span>
                                <span class="stat-number"><?= date('d/m/Y', userHome('account_created')); ?></span>
                            </div>
                            <div class="stat-row">
                                <span class="stat-name">Última conexión</span>
                                <span class="stat-number"><?= date('d/m/Y', userHome('last_online')); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Groups Card -->
                    <div class="card-modern animate-fade-in delay-2">
                        <div class="card-header">
                            <i class="fas fa-users"></i>
                            <span>Grupos</span>
                        </div>
                        <div class="card-body groups-overflow">
                            <?php include_once("get/profile/homeGroups.php"); ?>
                        </div>
                    </div>

                    <!-- Friends Card -->
                    <div class="card-modern animate-fade-in delay-3">
                        <div class="card-header">
                            <i class="fas fa-heart"></i>
                            <span>Amigos</span>
                        </div>
                        <div class="card-body friends-grid-mini">
                            <?php include_once("get/profile/homeFriends.php"); ?>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="profile-grid-main">
                    <!-- Badges Section -->
                    <div class="card-modern animate-fade-in delay-1">
                        <div class="card-header">
                            <i class="fas fa-award"></i>
                            <span>Colección de Placas</span>
                        </div>
                        <div class="card-body">
                            <div class="badges-display-grid">
                                <?php include_once("get/profile/homeBadges.php"); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Rooms Section -->
                    <div class="card-modern animate-fade-in delay-2">
                        <div class="card-header">
                            <i class="fas fa-door-open"></i>
                            <span>Salas Creadas</span>
                        </div>
                        <div class="card-body">
                            <div class="rooms-display-list">
                                <?php include_once("get/profile/homeRooms.php"); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Photos Section -->
                    <div class="card-modern animate-fade-in delay-3">
                        <div class="card-header">
                            <i class="fas fa-camera"></i>
                            <span>Galería de Fotos</span>
                        </div>
                        <div class="card-body">
                            <div class="photos-display-grid">
                                <?php include_once("get/profile/homePhotos.php"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="profile-footer">
                <p>&copy; <?= date('Y') ?> <?= $config['hotelName'] ?> Hotel. Todos los derechos reservados.</p>
            </footer>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>
