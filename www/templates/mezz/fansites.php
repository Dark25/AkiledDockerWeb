<?php
$fansite_active = 'active';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/styles/fansites.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" href="/assets/styles/fansites-dark.css" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

                <!-- Immersive Hero v2 -->
                <div class="fansites-hero-v2">
                    <div class="fansites-hero-v2-badge"><?= $lang["Mcomunidad"] ?></div>
                    <h1 class="fansites-hero-v2-title"><?= $lang["FsTitle"] ?></h1>
                    <p class="fansites-hero-v2-subtitle"><?= $lang["FsDesc"] ?></p>
                </div>

                <div class="page-content-max-width has-sidebar" style="width: 100%; padding: 0;">
                    <!-- Main Content: Social Fansites Grid -->
                    <div class="page-content-main-column">
                        <div class="fansites-social-grid">
                            <?php
                            $getFs = $dbh->prepare("SELECT c.*, u.look FROM cms_fansites c INNER JOIN users u ON c.ceo = u.username");
                            $getFs->execute();
                            $allFs = $getFs->fetchAll();

                            if (count($allFs) > 0) {
                                foreach ($allFs as $FsRow) {
                            ?>
                                    <div class="social-fs-card">
                                        <div class="social-fs-card-header">
                                            <div class="social-fs-card-avatar-wrap">
                                                <div class="social-fs-card-avatar" style="background-image: url(<?= htmlspecialchars($config['AvatarURL'] . rawurlencode($FsRow['look']) . '&direction=2&head_direction=2&gesture=sml&size=m&headonly=1', ENT_QUOTES, 'UTF-8') ?>)"></div>
                                            </div>
                                        </div>
                                        <div class="social-fs-card-body">
                                            <h3 class="social-fs-card-name"><?= filter($FsRow['name']) ?></h3>
                                            <p class="social-fs-card-desc"><?= filter($FsRow['description']) ?></p>
                                            <div class="social-fs-card-meta">
                                                <span><i class="fas fa-user-tie"></i> <strong><?= filter($FsRow['ceo']) ?></strong></span>
                                                <span><i class="fas fa-certificate"></i> <strong>Oficial</strong></span>
                                            </div>
                                        </div>
                                        <div class="social-fs-card-footer">
                                            <a href="<?= filter($FsRow['link']) ?>" target="_blank" class="social-fs-visit-btn">
                                                Visitar Sitio <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="social-fs-card" style="grid-column: 1/-1; padding: 60px; text-align: center;">
                                    <i class="fas fa-ghost" style="font-size: 64px; color: var(--fs-accent); margin-bottom: 20px; opacity: 0.5;"></i>
                                    <h3 class="social-fs-card-name">¡Vaya, qué silencio!</h3>
                                    <p class="social-fs-card-desc">No hay fansites oficiales registrados en este momento. ¡Vuelve pronto!</p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Sidebar: Premium Info Boxes -->
                    <div class="page-content-sidebar">
                    
                        <?php include_once('includes/sidebar.php'); ?>
                         <div class="info-box-premium">
                            <h3 class="info-box-premium-title">
                                <i class="fas fa-rocket"></i> Únete al Programa
                            </h3>
                            <p class="info-box-premium-text">
                                <?= $lang["FsDesc2"] ?>
                            </p>
                            <div class="info-box-premium-divider"></div>
                            <h3 class="info-box-premium-title">
                                <i class="fas fa-shield-virus"></i> Navega Seguro
                            </h3>
                            <p class="info-box-premium-text">
                                <?= $lang["FsDesc3"] ?>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>
