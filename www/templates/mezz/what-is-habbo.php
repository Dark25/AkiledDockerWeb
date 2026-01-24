<?php
$whatishabbo_active = 'active';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/what-is-habbo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $lang['TittleHader2']?></title>
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

        <div class="wh-header-section">
            <div class="page-content-max-width">
                <div class="wh-hero-card">
                    <div class="wh-hero-text">
                        <div class="wh-hero-badge"><?= $lang["Mcomunidad"] ?></div>
                        <h1 class="wh-hero-title">¿Qué es <?= filter($config['hotelName']) ?>?</h1>
                        <p class="wh-hero-subtitle">Descubre un mundo virtual infinito donde la imaginación no tiene límites.</p>
                    </div>
                    <div class="wh-hero-icon-container">
                        <i class="fas fa-cubes"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content-collider" style="background-color: transparent;">
            <div class="page-content-max-width has-sidebar">
                <div class="page-content-main-column">
                    <div class="wh-grid">
                        <!-- Card 1: What is Habbo -->
                        <div class="wh-card">
                            <div class="wh-card-icon">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <h2 class="wh-card-title"><?= $lang["FAQtitle1"] ?></h2>
                            <div class="wh-card-description">
                                <?= filter($config['hotelName']) ?> <?= $lang["FAQdesc1"] ?>
                                <strong><?= $lang["FAQdesc1bold"] ?></strong>
                                <?= $lang["FAQdesc1.2"] ?>
                            </div>
                        </div>

                        <!-- Card 2: More than a game -->
                        <div class="wh-card">
                            <div class="wh-card-icon">
                                <i class="fas fa-gamepad"></i>
                            </div>
                            <h2 class="wh-card-title"><?= $lang["FAQtitle2"] ?></h2>
                            <div class="wh-card-description">
                                <?= $lang["FAQdesc2"] ?>
                                <strong><?= $lang["FAQdesc2bold"] ?></strong>
                                <?= $lang["FAQdesc2.1"] ?>
                                <strong><?= $lang["FAQdesc2.1bold"] ?></strong>
                                <?= $lang["FAQdesc2.2"] ?>
                            </div>
                            <img src="/assets/images/playing-habbo/ill_15.png" alt="Habbo Game" class="wh-card-image">
                        </div>

                        <!-- Card 3: Community -->
                        <div class="wh-card">
                            <div class="wh-card-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h2 class="wh-card-title"><?= $lang["FAQtitle3"] ?></h2>
                            <div class="wh-card-description">
                                <?= $lang["FAQdesc3"] ?>
                                <strong><?= $lang["FAQdesc3bold"] ?></strong>
                                <?= $lang["FAQdesc3.1"] ?>
                            </div>
                        </div>

                        <!-- Card 4: Expression -->
                        <div class="wh-card">
                            <div class="wh-card-icon">
                                <i class="fas fa-palette"></i>
                            </div>
                            <h2 class="wh-card-title"><?= $lang["FAQtitle4"] ?></h2>
                            <div class="wh-card-description">
                                <?= $lang["FAQdesc4"] ?>
                                <strong><?= $lang["FAQdesc4bold"] ?></strong>
                                <?= $lang["FAQdesc4.1"] ?>
                            </div>
                            <img src="/assets/images/playing-habbo/ill_16.png" alt="Creativity" class="wh-card-image">
                        </div>

                        <!-- Card 5: Free Play -->
                        <div class="wh-card">
                            <div class="wh-card-icon">
                                <i class="fas fa-coins"></i>
                            </div>
                            <h2 class="wh-card-title"><?= $lang["FAQtitle5"] ?></h2>
                            <div class="wh-card-description">
                                <?= filter($config['hotelName']) ?>
                                <?= $lang["FAQdesc5"] ?>
                                <strong><?= $lang["FAQdesc5bold"] ?></strong>, <?= $lang["FAQdesc5.1"] ?>
                            </div>
                            <div class="wh-card-description">
                                <?= $lang["FAQdesc5.2"] ?>
                                <a href="/shop" class="wh-card-link"><?= $lang["HeaderShop1"] ?></a>.
                            </div>
                        </div>

                        <!-- Card 6: Safety -->
                        <div class="wh-card">
                            <div class="wh-card-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h2 class="wh-card-title"><?= $lang["FAQtitle6"] ?></h2>
                            <div class="wh-card-description">
                                <?= $lang["FAQdesc6"] ?>
                                <a href="/safety" class="wh-card-link"><?= $lang["TittleHader7"] ?></a>.
                            </div>
                            <div class="wh-card-description">
                                <?= $lang["FAQdesc6.1"] ?>
                                <strong><?= $lang["FAQdesc6bold"] ?></strong>
                                <?= $lang["FAQdesc6.2"] ?>
                            </div>
                            <img src="/assets/images/playing-habbo/ill_17.png" alt="Safety" class="wh-card-image">
                        </div>
                    </div>
                </div>

                <?php include_once('includes/sidebar.php'); ?>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>