<?php
$shop_active = 'active';
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
    <script src="/assets/scripts/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $lang["TittleHader"] ?></title>
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
            <div class="page-content-max-width has-sidebar">
                <div class="page-content-main-column">

                    <div class="shop-header">
                        <div class="shop-header-content">
                            <h1 class="shop-header-title"><?= $lang["Shoptitle"] ?></h1>
                            <p class="shop-header-subtitle">¡Bienvenido a la tienda oficial de <?= $config['hotelName'] ?>!</p>
                        </div>
                        <img src="/assets/images/shop/habbo-club.png" class="shop-header-image">
                    </div>

                    <!-- Loteria Section -->
                    <div class="loteria-card">
                        <div class="section-title">
                            <img src="/assets/images/user-space/duckets.png">
                            <span><?= $lang["LoteriaTitle"] ?></span>
                        </div>
                        <div class="loteria-desc">
                            <?= $lang["LoteriaDesc"] ?>
                        </div>
                        <?php include_once("shop/loteria.php"); ?>
                    </div>

                    <!-- Badges Section -->
                    <div class="loteria-card">
                        <div class="section-title">
                            <img src="/assets/images/highscores/trophy-gold.png">
                            <span><?= $lang["PlacasTitle"] ?></span>
                        </div>
                        <div class="badges-grid">
                            <?php include_once("shop/placas.php"); ?>
                        </div>
                    </div>

                </div>

                <div class="page-content-sidebar">

                    <!-- My Purse Widget -->
                    <div class="sidebar-widget user-card">
                        <div class="widget-title" style="padding: 20px 24px 0 24px; display: flex; align-items: center; gap: 10px;">
                            <img src="/assets/images/user-space/credits.png" style="width: 24px; height: 24px;">
                            <h3 style="font-size: 16px; font-weight: 700;"><?= $lang["MyPurse"] ?></h3>
                        </div>
                        <div class="purse-widget">
                            <div class="purse-item">
                                <img src="/assets/images/shop/credits.png" class="purse-icon">
                                <div class="purse-info">
                                    <span class="purse-value"><?= number_format(User::userData('credits')) ?></span>
                                    <span class="purse-label"><?= $lang["topcredits"] ?></span>
                                </div>
                            </div>
                            <div class="purse-item">
                                <img src="/assets/images/shop/esmeralda.png" class="purse-icon">
                                <div class="purse-info">
                                    <span class="purse-value"><?= number_format(User::userData('activity_points')) ?></span>
                                    <span class="purse-label"><?= $lang["topdiamonds"] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buy VIP Widget -->
                    <div class="sidebar-widget vip-card">
                        <h3 class="vip-title"><?= $lang["BuyVIP"] ?></h3>
                        <div class="vip-desc">
                            <?php buyvip(); ?>
                            <?= $lang["VvipBuyslogan"] ?><br>
                            <?= $lang["VvipBuyslogan2"] ?>
                        </div>
                        <form method="post">
                            <button type="submit" name="getvip" class="vip-btn">
                                <?= $lang["VvipBuyButton"] ?>
                            </button>
                        </form>
                    </div>

                    <!-- Help Widget -->
                    <div class="sidebar-widget">
                        <div class="widget-title" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                            <img src="/assets/images/collider/feeds.png" style="width: 24px; height: 24px;">
                            <h3 style="font-size: 16px; font-weight: 700;"><?= $lang["HelpPay"] ?></h3>
                        </div>
                        <div class="help-box">
                            <?= $lang["HelpPayDesc"] ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js" defer></script>
    <script>
        $().ready(function() {
            setTimeout(function() {
                $('.error').hide();
            }, 3500);
        });
    </script>
</body>

</html>