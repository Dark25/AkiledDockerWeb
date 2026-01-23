<?php
$fansite_active = 'active';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/styles/app.css">
    <link rel="stylesheet" href="/assets/styles/fansites.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $lang["TittleHader14"] ?></title>
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

        <div class="page-content-collider" style="background-color: transparent;">
            <div class="page-content-max-width" style="flex-direction: column;">

                <!-- Hero Section -->
                <div class="fansites-hero">
                    <div class="fansites-hero-content">
                        <div class="fansites-hero-badge"><?= $lang["Mcomunidad"] ?></div>
                        <h1 class="fansites-hero-title"><?= $lang["FsTitle"] ?></h1>
                        <p class="fansites-hero-subtitle"><?= $lang["FsDesc"] ?></p>
                    </div>
                    <div class="fansites-hero-icon">
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="page-content-max-width has-sidebar" style="width: 100%; padding: 0;">
                    <!-- Main Content: Fansites Grid -->
                    <div class="page-content-main-column">
                        <div class="fansites-grid">
                            <?php
                            $getFs = $dbh->prepare("SELECT c.*, u.look FROM cms_fansites c INNER JOIN users u ON c.ceo = u.username");
                            $getFs->execute();
                            $allFs = $getFs->fetchAll();

                            if (count($allFs) > 0) {
                                foreach ($allFs as $FsRow) {
                            ?>
                                    <div class="fansite-card">
                                        <div class="fansite-card-header">
                                            <div class="fansite-verified-badge">
                                                <i class="fas fa-check-circle" title="Oficial"></i>
                                            </div>
                                            <div class="fansite-owner-avatar" style="background-image: url(<?= htmlspecialchars($config['AvatarURL'] . rawurlencode($FsRow['look']) . '&direction=2&head_direction=2&gesture=sml&size=m&headonly=1', ENT_QUOTES, 'UTF-8') ?>)"></div>
                                        </div>
                                        <div class="fansite-card-body">
                                            <h3 class="fansite-name"><?= filter($FsRow['name']) ?></h3>
                                            <p class="fansite-description"><?= filter($FsRow['description']) ?></p>
                                            <div class="fansite-owner-info">
                                                Fundado por: <strong><?= filter($FsRow['ceo']) ?></strong>
                                            </div>
                                        </div>
                                        <div class="fansite-card-actions">
                                            <a href="<?= filter($FsRow['link']) ?>" target="_blank" class="fansite-visit-btn">
                                                Visitar Sitio <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="fansites-empty" style="grid-column: 1/-1; text-align: center; padding: 60px 20px; background: var(--fs-card-bg); border-radius: 20px; border: 2px dashed var(--fs-card-border);">
                                    <i class="fas fa-heart-broken" style="font-size: 50px; color: var(--fs-card-sub); margin-bottom: 15px; opacity: 0.5; display: block;"></i>
                                    <p style="color: var(--fs-card-sub); font-size: 16px; margin: 0;">No hay fansites en este momento.</p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="page-content-sidebar">
                        <div class="fansite-sidebar-card">
                            <h3 class="fansite-sidebar-title">
                                <i class="fas fa-info-circle"></i> Sobre los Fansites
                            </h3>
                            <p class="fansite-sidebar-text">
                                <?= $lang["FsDesc2"] ?>
                            </p>
                            <div class="fansite-sidebar-divider"></div>
                            <h3 class="fansite-sidebar-title">
                                <i class="fas fa-shield-alt"></i> Seguridad Ante Todo
                            </h3>
                            <p class="fansite-sidebar-text">
                                <?= $lang["FsDesc3"] ?>
                            </p>
                        </div>

                        <?php include_once('includes/sidebar.php'); ?>
                    </div>
                </div>

            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>
