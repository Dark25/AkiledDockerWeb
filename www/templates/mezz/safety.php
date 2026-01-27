<?php
$safety_active = 'active';
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
    <link rel="stylesheet" type="text/css" href="/assets/styles/safety-pages.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/safety-pages-dark.css" media="(prefers-color-scheme: dark)">
    <script src="/assets/scripts/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>:  <?= $lang["TittleHader7"] ?></title>
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
            <div class="safety-container">
                <section class="hero-section safety">
                    <div class="hero-content">
                        <h1 class="hero-title"><?= $lang["FAQtitle31"] ?></h1>
                        <p class="hero-subtitle"><?= $lang["FAQdesc31"] ?></p>
                    </div>
                </section>

                <div class="safety-grid">
                    <div class="safety-card">
                        <div class="safety-card-image">
                            <img src="/assets/images/playing-habbo/safetytips1_n.png" alt="Safety Tip 1">
                        </div>
                        <h3 class="safety-card-title"><?= $lang["FAQtitle32"] ?></h3>
                        <p class="safety-card-desc"><?= $lang["FAQdesc32"] ?></p>
                    </div>

                    <div class="safety-card">
                        <div class="safety-card-image">
                            <img src="/assets/images/playing-habbo/safetytips2_n.png" alt="Safety Tip 2">
                        </div>
                        <h3 class="safety-card-title"><?= $lang["FAQtitle33"] ?></h3>
                        <p class="safety-card-desc"><?= $lang["FAQdesc33"] ?></p>
                    </div>

                    <div class="safety-card">
                        <div class="safety-card-image">
                            <img src="/assets/images/playing-habbo/safetytips3_n.png" alt="Safety Tip 3">
                        </div>
                        <h3 class="safety-card-title"><?= $lang["FAQtitle34"] ?></h3>
                        <p class="safety-card-desc"><?= $lang["FAQdesc34"] ?></p>
                    </div>

                    <div class="safety-card">
                        <div class="safety-card-image">
                            <img src="/assets/images/playing-habbo/safetytips4_n.png" alt="Safety Tip 4">
                        </div>
                        <h3 class="safety-card-title"><?= $lang["FAQtitle35"] ?></h3>
                        <p class="safety-card-desc"><?= $lang["FAQdesc35"] ?></p>
                    </div>

                    <div class="safety-card">
                        <div class="safety-card-image">
                            <img src="/assets/images/playing-habbo/safetytips5_n.png" alt="Safety Tip 5">
                        </div>
                        <h3 class="safety-card-title"><?= $lang["FAQtitle36"] ?></h3>
                        <p class="safety-card-desc"><?= $lang["FAQdesc36"] ?></p>
                    </div>

                    <div class="safety-card">
                        <div class="safety-card-image">
                            <img src="/assets/images/playing-habbo/safetytips6_n.png" alt="Safety Tip 6">
                        </div>
                        <h3 class="safety-card-title"><?= $lang["FAQtitle37"] ?></h3>
                        <p class="safety-card-desc"><?= $lang["FAQdesc37"] ?></p>
                    </div>

                    <div class="safety-card">
                        <div class="safety-card-image">
                            <img src="/assets/images/playing-habbo/safetytips7_n.png" alt="Safety Tip 7">
                        </div>
                        <h3 class="safety-card-title"><?= $lang["FAQtitle38"] ?></h3>
                        <p class="safety-card-desc"><?= $lang["FAQdesc38"] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js" defer></script>
</body>

</html>
