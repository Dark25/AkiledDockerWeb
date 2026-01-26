<?php
$report_active = 'active';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/styles/app.css">
    <link rel="stylesheet" href="/assets/styles/help.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" href="/assets/styles/help-dark.css" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                        <div class="help-hero-badge">Soporte Oficial</div>
                        <h1 class="help-hero-title">Centro de Ayuda</h1>
                        <p class="help-hero-subtitle">¿Tienes algún problema? Nuestro equipo técnico y de moderación
                            está disponible para apoyarte en lo que necesites.</p>
                    </div>

                    <!-- Thematic game images (decorative) -->
                    <img src="/templates/sloptv4.2/assets/images/park.png" alt="park" class="help-hero-figure help-hero-figure--left">

                    <div class="help-hero-icon-container">
                        <i class="fas fa-headset"></i>
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
                            <p class="help-card-main-subtitle">Completa el formulario y nos pondremos en contacto
                                contigo lo antes posible.</p>
                        </div>
                        <?php include_once("report/sendReport.php"); ?>
                    </div>
                </div>

                <div class="page-content-sidebar">
                    <div class="help-side-card">
                        <div class="help-side-card-header">
                            <h3 class="help-side-card-title"><i class="fas fa-history mr-2"></i> Mis Informes</h3>
                        </div>
                        <div class="help-side-card-body">
                            <?php include_once("report/ListMyReports.php"); ?>
                        </div>
                    </div>

                    <div class="help-side-card">
                        <div class="help-side-card-header">
                            <h3 class="help-side-card-title"><i class="fas fa-external-link-alt mr-2"></i> Enlaces
                                Útiles</h3>
                        </div>
                        <div class="help-side-card-body">
                            <a href="/safety/habbo-way" class="help-sidebar-link">
                                <span class="link-icon"><i class="fas fa-scroll"></i></span>
                                <span class="link-text">La Manera de Akiled</span>
                            </a>
                            <a href="/safety/safety" class="help-sidebar-link">
                                <span class="link-icon"><i class="fas fa-shield-alt"></i></span>
                                <span class="link-text">Consejos de Seguridad</span>
                            </a>
                            <a href="/safety/how-to-play" class="help-sidebar-link">
                                <span class="link-icon"><i class="fas fa-question-circle"></i></span>
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