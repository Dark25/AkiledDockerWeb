<?php
$howtoplay_active = 'active';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/how-to-play.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/how-to-play-dark.css" media="(prefers-color-scheme: dark)">
    <title><?= $config['hotelName'] ?>: <?= $lang["TittleHader10"] ?></title>
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

        <div class="page-content-collider">
            <div class="how-to-play-container">

                <section class="htp-hero">
                    <div class="htp-hero-content">
                        <h1 class="htp-hero-title"><?= $lang["FAQtitle7"] ?></h1>
                        <p class="htp-hero-description"><?= $lang["FAQdesc7"] ?></p>
                    </div>
                </section>

                <section class="htp-steps">
                    <!-- Step 1 -->
                    <div class="htp-step-card">
                        <div class="htp-step-image">
                            <img src="/assets/images/playing-habbo/navigator.png" alt="<?= $lang["FAQtitle8"] ?>">
                        </div>
                        <div class="htp-step-content">
                            <span class="htp-step-number">1</span>
                            <h3 class="htp-step-title"><?= $lang["FAQtitle8"] ?></h3>
                            <p class="htp-step-desc"><?= $lang["FAQdesc8"] ?></p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="htp-step-card">
                        <div class="htp-step-image">
                            <img src="/assets/images/playing-habbo/askfriend.png" alt="<?= $lang["FAQtitle9"] ?>">
                        </div>
                        <div class="htp-step-content">
                            <span class="htp-step-number">2</span>
                            <h3 class="htp-step-title"><?= $lang["FAQtitle9"] ?></h3>
                            <p class="htp-step-desc"><?= $lang["FAQdesc9"] ?></p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="htp-step-card">
                        <div class="htp-step-image">
                            <img src="/assets/images/playing-habbo/gamehub.png" alt="<?= $lang["FAQtitle10"] ?>">
                        </div>
                        <div class="htp-step-content">
                            <span class="htp-step-number">3</span>
                            <h3 class="htp-step-title"><?= $lang["FAQtitle10"] ?></h3>
                            <p class="htp-step-desc"><?= $lang["FAQdesc10"] ?></p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="htp-step-card">
                        <div class="htp-step-image">
                            <img src="/assets/images/playing-habbo/shop.png" alt="<?= $lang["FAQtitle11"] ?>">
                        </div>
                        <div class="htp-step-content">
                            <span class="htp-step-number">4</span>
                            <h3 class="htp-step-title"><?= $lang["FAQtitle11"] ?></h3>
                            <p class="htp-step-desc"><?= $lang["FAQdesc11"] ?></p>
                        </div>
                    </div>
                </section>

                <section class="htp-footer-info">
                    <h2 class="htp-footer-title"><?= $lang["FAQtitle12"] ?></h2>
                    <p class="htp-footer-desc"><?= $lang["FAQdesc12"] ?></p>
                    <p class="htp-footer-desc"><?= $lang["FAQdesc12.1"] ?></p>
                </section>

            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>
