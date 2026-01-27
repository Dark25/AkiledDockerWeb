<?php
$whatishabbo_active = 'active';
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

    <link rel="stylesheet" type="text/css" href="/assets/styles/what-is-habbo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="/assets/scripts/jquery.min.js"></script>
    <title><?= $lang['TittleHader2'] ?></title>
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
            <div class="page-content-max-width" style="flex-direction: column; align-items: center;">
                <div class="what-is-habbo-container">
                    <section class="hero-section">
                        <div class="hero-content">
                            <h1 class="hero-title"><?= $lang["TittleHader2"] ?></h1>
                            <p class="hero-subtitle">
                                <?= $config['hotelName'] ?> <?= $lang["FAQdesc1"] ?>
                                <strong><?= $lang["FAQdesc1bold"] ?></strong>
                                <?= $lang["FAQdesc1.2"] ?>
                            </p>
                            <div class="hero-image">
                                <img src="/assets/images/playing-habbo/ill_15.png" alt="Habbo Hero">
                            </div>
                        </div>
                    </section>

                    <section class="features-grid">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <img src="/assets/images/playing-habbo/ill_16.png" alt="Express yourself">
                            </div>
                            <h3 class="feature-title"><?= $lang["FAQtitle4"] ?></h3>
                            <p class="feature-desc">
                                <?= $lang["FAQdesc4"] ?>
                                <strong><?= $lang["FAQdesc4bold"] ?></strong>
                                <?= $lang["FAQdesc4.1"] ?>
                            </p>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <img src="/assets/images/playing-habbo/navigator.png" alt="Find your community">
                            </div>
                            <h3 class="feature-title"><?= $lang["FAQtitle3"] ?></h3>
                            <p class="feature-desc">
                                <?= $lang["FAQdesc3"] ?>
                                <strong><?= $lang["FAQdesc3bold"] ?></strong>
                                <?= $lang["FAQdesc3.1"] ?>
                            </p>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <img src="/assets/images/playing-habbo/shop.png" alt="Play for free">
                            </div>
                            <h3 class="feature-title"><?= $lang["FAQtitle5"] ?></h3>
                            <p class="feature-desc">
                                <?= $config['hotelName'] ?> <?= $lang["FAQdesc5"] ?>
                                <strong><?= $lang["FAQdesc5bold"] ?></strong>,
                                <?= $lang["FAQdesc5.1"] ?>
                                <?= $lang["FAQdesc5.2"] ?>
                                <?= $lang["FAQdescshoplink"] ?>
                            </p>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <img src="/assets/images/playing-habbo/ill_17.png" alt="Always here to help">
                            </div>
                            <h3 class="feature-title"><?= $lang["FAQtitle6"] ?></h3>
                            <p class="feature-desc">
                                <?= $lang["FAQdesc6"] ?>
                                <?= $lang["FAQdescsafetylink"] ?>.
                                <?= $lang["FAQdesc6.1"] ?>
                                <strong><?= $lang["FAQdesc6bold"] ?></strong>
                                <?= $lang["FAQdesc6.2"] ?>
                            </p>
                        </div>
                    </section>

                    <section class="more-than-game">
                        <div class="more-content">
                            <div class="more-text">
                                <h2 class="more-title"><?= $lang["FAQtitle2"] ?></h2>
                                <p>
                                    <?= $lang["FAQdesc2"] ?>
                                    <strong><?= $lang["FAQdesc2bold"] ?></strong>
                                    <?= $lang["FAQdesc2.1"] ?>
                                    <strong><?= $lang["FAQdesc2.1bold"] ?></strong>
                                    <?= $lang["FAQdesc2.2"] ?>
                                </p>
                            </div>
                            <div class="more-image">
                                <img src="/assets/images/playing-habbo/gamehub.png" alt="Game Hub">
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>
