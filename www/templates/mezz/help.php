<?php
$report_active = 'active';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/help.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $lang["TittleHader12"] ?></title>
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

        <div class="help-header-section">
            <div class="page-content-max-width">
                <div class="help-hero-card">
                    <div class="help-hero-text">
                        <h1 class="help-hero-title">Centro de Ayuda</h1>
                        <p class="help-hero-subtitle">¿Tienes algún problema? Nuestro equipo está aquí para apoyarte.</p>
                    </div>
                    <div class="help-hero-icon-container">
                        <i class="fas fa-life-ring"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content-collider" style="background-color: transparent;">
            <div class="page-content-max-width has-sidebar">
                <div class="page-content-main-column">
                    <div class="help-main-card">
                        <div class="help-card-header">
                            <h2 class="help-card-main-title">Enviar un reporte</h2>
                            <p class="help-card-main-subtitle">Cuéntanos qué sucede y te ayudaremos lo antes posible.</p>
                        </div>
                        <?php include_once("report/sendReport.php"); ?>
                    </div>
                </div>

                <div class="page-content-sidebar">
                    <div class="help-side-card">
                        <div class="help-side-card-header">
                            <h3 class="help-side-card-title">Mis Informes</h3>
                        </div>
                        <div class="help-side-card-body">
                            <?php include_once("report/ListMyReports.php"); ?>
                        </div>
                    </div>

                    <div class="help-side-card">
                        <div class="help-side-card-header">
                            <h3 class="help-side-card-title">Enlaces Útiles</h3>
                        </div>
                        <div class="help-side-card-body">
                            <a href="/safety/habbo-way" class="help-sidebar-link">
                                <span class="link-icon">📜</span>
                                <span class="link-text">La Manera de Akiled</span>
                            </a>
                            <a href="/safety/safety" class="help-sidebar-link">
                                <span class="link-icon">🛡️</span>
                                <span class="link-text">Consejos de Seguridad</span>
                            </a>
                            <a href="/safety/how-to-play" class="help-sidebar-link">
                                <span class="link-icon">❓</span>
                                <span class="link-text">Preguntas Frecuentes</span>
                            </a>
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
