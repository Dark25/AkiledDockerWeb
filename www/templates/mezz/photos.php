<?php
$photos_active = 'active';

// Hero background: ensure fallback copy exists in assets/images
$heroFileName = '27419_appart732_scene.gif';
$heroSrcRel = '/swfs/c_images/backgrounds2/'.$heroFileName;
$heroDestRel = '/assets/images/'.$heroFileName;

// Resolve filesystem paths based on this file location
$baseDir = dirname(__DIR__, 2); // points to www/
$srcPath = $baseDir . '/swfs/c_images/backgrounds2/' . $heroFileName;
$destDir = $baseDir . '/assets/images';
$destPath = $destDir . '/' . $heroFileName;

// Try to create assets/images dir if it doesn't exist
if (!is_dir($destDir)) {
    @mkdir($destDir, 0755, true);
}

// Copy file from swfs to assets/images if possible and not already present
if (!file_exists($destPath) && file_exists($srcPath) && is_readable($srcPath)) {
    @copy($srcPath, $destPath);
}

// Use the assets image if available, otherwise use the swfs URL
$heroUrl = file_exists($destPath) ? $heroDestRel : $heroSrcRel;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/styles/photos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="/assets/scripts/jquery.min.js"></script>
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
                <div class="photos-hero" style="background-image: linear-gradient(90deg, rgba(98,58,221,0.88), rgba(156,221,230,0.65)), url('<?= $heroUrl ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                    <div class="photos-hero-content">
                        <div class="photos-hero-badge">COMUNIDAD</div>
                        <h1 class="photos-hero-title"><?= $lang["Plastphotos"] ?></h1>
                        <p class="photos-hero-subtitle"><?= $lang["Pdescphotos"] ?></p>
                    </div>
                    <div class="photos-hero-icon">
                        <i class="fas fa-camera-retro"></i>
                    </div>
                </div>

                <div class="page-content-max-width"
                    style="display: flex; gap: 20px; align-items: flex-start; width: 100%; max-width: 1200px; margin: 0 auto;">

                    <!-- COLUMNA IZQUIERDA (FOTOS) -->
                    <!-- Le damos flex: 1 para que ocupe el mayor espacio posible -->
                    <div class="page-content-main" style="flex: 1; min-width: 0;">

                        <div class="photos-grid">
                            <?php
                            $getPhotos = $dbh->prepare("SELECT user_photos.photo, user_photos.time, users.username, users.look FROM user_photos JOIN users ON user_photos.user_id = users.id ORDER BY user_photos.time DESC LIMIT 24");
                            $getPhotos->execute();

                            if ($getPhotos->rowCount() > 0) {
                                while ($photosRow = $getPhotos->fetch()) {
                                    $imgUrl = $config['roomphotos'] . filter($photosRow['photo']) . ".png";
                                    ?>
                                    <article class="photo-card">
                                        <div class="photo-image-container">
                                            <img src="<?= $imgUrl ?>" alt="Foto de <?= filter($photosRow['username']) ?>"
                                                loading="lazy" decoding="async">
                                        </div>
                                        <div class="photo-details">
                                            <div style="display:flex;align-items:center;gap:10px">
                                                <a href="/profile/<?= filter($photosRow['username']) ?>"
                                                    class="photo-author-avatar-link"
                                                    aria-label="Ver perfil de <?= filter($photosRow['username']) ?>">
                                                    <div class="photo-author-avatar"
                                                        style="background-image: url('<?= $config['AvatarURL'] . filter($photosRow['look']) ?>&direction=2&head_direction=2&gesture=sml&headonly=1&size=b');">
                                                    </div>
                                                </a>
                                                <div class="photo-meta" style="display:flex;flex-direction:column">
                                                    <a href="/profile/<?= filter($photosRow['username']) ?>"
                                                        style="font-weight:bold;text-decoration:none;color:inherit"><?= filter($photosRow['username']) ?></a>
                                                    <span class="photo-time"
                                                        style="font-size:11px;opacity:.6"><?= GetLast($photosRow['time']) ?></span>
                                                </div>
                                            </div>
                                            <a href="<?= $imgUrl ?>" target="_blank" rel="noopener noreferrer"
                                                class="photo-action-btn" title="Ver imagen completa"
                                                aria-label="Abrir imagen completa" style="color:inherit;opacity:.8">
                                                <i class="fas fa-external-link-alt" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </article>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="photos-empty">
                                    <i class="fas fa-camera" style="font-size:40px;margin-bottom:10px;opacity:.5"
                                        aria-hidden="true"></i>
                                    <p>No hay fotos en este momento. ¡Sé el primero en capturar un momento!</p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <!-- COLUMNA DERECHA (SIDEBAR) -->
                    <!-- Envolvemos el include en un div con ancho fijo para evitar que rompa el diseño -->
                    <div class="page-sidebar-wrapper"
                        style="width: 320px; flex-shrink: 0; display: flex; flex-direction: column; gap: 20px;">
                        <?php include_once('includes/sidebar.php'); ?>
                    </div>

                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js" defer></script>
</body>

</html>