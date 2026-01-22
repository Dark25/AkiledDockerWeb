<?php
$photos_active = 'active';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/photos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $lang["TittleHader9"] ?></title>
</head>

<body class="container">
    <?php User::Login(); ?>
    <script src="/assets/scripts/page-load.js"></script>
    <div class="page-content">
        <?php
        if (!isset($_SESSION['id'])) {
            include('auth/login.php');
        } else {
            include('auth/logged.php');
        }
        ?>

        <?php include_once('includes/menu.php'); ?>

        <div class="page-content-collider">
            <div class="page-content-max-width" style="flex-direction: column;">
                <!-- Hero Section -->
                <div class="photos-hero">
                    <div class="photos-hero-content">
                        <div class="photos-hero-badge">COMUNIDAD</div>
                        <h1 class="photos-hero-title"><?= $lang["Plastphotos"] ?></h1>
                        <p class="photos-hero-subtitle"><?= $lang["Pdescphotos"] ?></p>
                    </div>
                    <div class="photos-hero-icon">
                        <i class="fas fa-camera-retro"></i>
                    </div>
                </div>

                <div class="page-content-max-width has-sidebar" style="width: 100%; padding: 0; align-items: flex-start;">
                    <div class="page-content-main">
                        <div class="photos-grid">
                            <?php
                            $getPhotos = $dbh->prepare("SELECT * FROM user_photos JOIN users ON user_photos.user_id = users.id ORDER BY time DESC LIMIT 24");
                            $getPhotos->execute();

                            if ($getPhotos->rowCount() > 0) {
                                while ($photosRow = $getPhotos->fetch()) {
                            ?>
                                    <div class="photo-card">
                                        <div class="photo-image-container">
                                            <div class="photo-image" style="background-image: url(<?php echo $config['roomphotos'] ?><?= filter($photosRow['photo']) ?>.png)"></div>
                                        </div>
                                        <div class="photo-details">
                                            <a href="/profile/<?= filter($photosRow['username']) ?>" class="photo-author-avatar-link">
                                                <div class="photo-author-avatar" style="background-image: url('<?php echo $config['AvatarURL']; ?><?= filter($photosRow['look']) ?>&direction=2&head_direction=2&gesture=sml&headonly=0&size=b')"></div>
                                            </a>
                                            <div class="photo-meta">
                                                <a href="/profile/<?= filter($photosRow['username']) ?>" class="photo-author-name"><?= filter($photosRow['username']) ?></a>
                                                <span class="photo-time"><?= GetLast($photosRow['time']) ?></span>
                                            </div>
                                            <a href="<?php echo $config['roomphotos'] ?><?= filter($photosRow['photo']) ?>.png" target="_blank" class="photo-action-btn" title="Ver imagen completa">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                            ?>
                                <div class="photos-empty">
                                    <i class="fas fa-camera"></i>
                                    <p>No hay fotos en este momento. ¡Sé el primero en capturar un momento!</p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <?php include_once('includes/sidebar.php'); ?>
                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>
