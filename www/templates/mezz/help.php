<?php
$report_active = 'active';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/help.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/help-dark.css" media="(prefers-color-scheme: dark)">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>:  <?= $lang["TittleHader12"] ?></title>
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

                <div class="help-hero">
                    <div class="help-hero-content">
                        <h1 class="help-hero-title">Centro de Ayuda</h1>
                        <p class="help-hero-subtitle">¿Tienes algún problema? Nuestro equipo está aquí para apoyarte.</p>
                    </div>
                    <img src="/assets/images/playing-habbo/navigator.png" class="help-hero-icon">
                </div>

                <div class="help-body">
                    <div class="help-main-content">
                        <?php include_once("report/sendReport.php"); ?>
                    </div>
                    <div class="help-side-content">
                        <div class="help-card">
                            <h3 class="help-card-title">Mis Informes</h3>
                            <div class="help-card-body">
                                <?php include_once("report/ListMyReports.php"); ?>
                            </div>
                        </div>

                        <div class="help-card">
                            <h3 class="help-card-title">Otros enlaces</h3>
                            <div class="help-card-body">
                                <a href="/safety/habbo-way" class="help-link">La Manera de <?= $config['hotelName'] ?></a>
                                <a href="/safety/safety" class="help-link">Consejos de Seguridad</a>
                                <a href="/safety/how-to-play" class="help-link">Preguntas Frecuentes</a>
                            </div>
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
