<?php
$hacerono_active = 'active';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/safety-pages.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/safety-pages-dark.css" media="(prefers-color-scheme: dark)">
    <title><?= $config['hotelName'] ?>:  <?= $lang["TittleHader13"] ?></title>
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
            <div class="habbo-way-container">
                <section class="hero-section habbo-way">
                    <div class="hero-content">
                        <h1 class="hero-title"><?= $lang["TittleHader13"] ?></h1>
                        <p class="hero-subtitle">Descubre cómo divertirte al máximo siguiendo el Habbo Way.</p>
                    </div>
                </section>

                <div class="habbo-way-columns">
                    <div class="way-column">
                        <h2 class="way-column-title do">
                            <img src="/assets/images/collider/public-room.png" style="width: 30px; height: 30px; image-rendering: pixelated;">
                            <?= $lang["FAQtitle13"] ?>
                        </h2>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_1a.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle14"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc14"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_2a.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle15"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc15"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_3a.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle16"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc16"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_4a.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle17"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc17"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_5a.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle18"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc18"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_6a.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle19"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc19"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_7a.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle20"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc20"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_8a.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle21"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc21"] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="way-column">
                        <h2 class="way-column-title dont">
                            <img src="/assets/images/not-found/frank-warning.png" style="width: 25px; height: 35px; image-rendering: pixelated;">
                            <?= $lang["FAQtitle22"] ?>
                        </h2>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_1a.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle23"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc23"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_2b.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle24"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc24"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_3b.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle25"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc25"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_4b.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle26"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc26"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_5b.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle27"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc27"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_6b.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle28"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc28"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_7b.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle29"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc29"] ?></p>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="rule-icon"><img src="/assets/images/playing-habbo/habboway_8b.png"></div>
                            <div class="rule-content">
                                <h3 class="rule-title"><?= $lang["FAQtitle30"] ?></h3>
                                <p class="rule-desc"><?= $lang["FAQdesc30"] ?></p>
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
