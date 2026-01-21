<?php
$shop_active = 'active';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $lang["TittleHader"] ?></title>
    <style>
        /* Modern Shop Redesign Styles */
        .shop-header {
            position: relative;
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 16px;
            margin-bottom: 30px;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 0 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .shop-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('/assets/images/header/pattern.png');
            opacity: 0.1;
            pointer-events: none;
        }

        .shop-header-content {
            position: relative;
            z-index: 2;
        }

        .shop-header-title {
            font-size: 32px;
            font-weight: 800;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .shop-header-subtitle {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 400;
        }

        .shop-header-image {
            position: absolute;
            right: 40px;
            bottom: -20px;
            height: 200px;
            z-index: 1;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.4));
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        /* Lottery Card */
        .loteria-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        @media (prefers-color-scheme: dark) {
            .loteria-card {
                background: rgba(31, 41, 55, 0.7);
                backdrop-filter: blur(12px);
                border-color: rgba(255, 255, 255, 0.05);
            }
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #1e293b;
        }

        @media (prefers-color-scheme: dark) {
            .section-title {
                color: #f1f5f9;
            }
        }

        .section-title img {
            width: 32px;
            height: 32px;
        }

        .loteria-desc {
            font-size: 15px;
            line-height: 1.6;
            color: #64748b;
            margin-bottom: 25px;
        }

        @media (prefers-color-scheme: dark) {
            .loteria-desc {
                color: #94a3b8;
            }
        }

        /* Badges Grid */
        .badges-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
        }

        .badge-card {
            background: #f8fafc;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        @media (prefers-color-scheme: dark) {
            .badge-card {
                background: #111827;
                border-color: rgba(255, 255, 255, 0.05);
            }
        }

        .badge-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            border-color: #eeb425;
        }

        .badge-image {
            width: 50px;
            height: 50px;
            object-fit: contain;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
            image-rendering: pixelated;
        }

        .badge-buy-btn {
            width: 100%;
            padding: 8px;
            background: #eeb425;
            color: #fff;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all 0.2s ease;
        }

        .badge-buy-btn:hover {
            background: #d9a322;
        }

        .badge-buy-btn.owned {
            background: #64748b;
            cursor: default;
        }

        .badge-buy-btn img {
            width: 14px;
            height: 14px;
        }

        /* Purse Widget */
        .purse-widget {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        @media (prefers-color-scheme: dark) {
            .purse-widget {
                background: transparent;
            }
        }

        .purse-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 15px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #f1f5f9;
            transition: all 0.2s ease;
        }

        @media (prefers-color-scheme: dark) {
            .purse-item {
                background: #111827;
                border-color: rgba(255, 255, 255, 0.05);
            }
        }

        .purse-item:hover {
            transform: translateX(5px);
            border-color: #e2e8f0;
        }

        .purse-icon {
            width: 30px;
            height: 30px;
            object-fit: contain;
        }

        .purse-info {
            display: flex;
            flex-direction: column;
        }

        .purse-value {
            font-size: 18px;
            font-weight: 800;
            color: #1e293b;
        }

        @media (prefers-color-scheme: dark) {
            .purse-value {
                color: #f1f5f9;
            }
        }

        .purse-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: #94a3b8;
            letter-spacing: 0.5px;
        }

        /* VIP Card */
        .vip-card {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 16px;
            padding: 24px;
            color: #fff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
        }

        .vip-card::before {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .vip-title {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .vip-desc {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .vip-btn {
            width: 100%;
            padding: 12px;
            background: #fff;
            color: #059669;
            border-radius: 10px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .vip-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            background: #f8fafc;
        }

        /* Help Box */
        .help-box {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
        }

        @media (prefers-color-scheme: dark) {
            .help-box {
                color: #94a3b8;
            }
        }

        .help-box b {
            color: #1e293b;
        }

        @media (prefers-color-scheme: dark) {
            .help-box b {
                color: #f1f5f9;
            }
        }

        .help-box a {
            color: #eeb425;
            text-decoration: none;
            font-weight: 600;
        }

        .help-box a:hover {
            text-decoration: underline;
        }

        .help-box p {
            margin-bottom: 12px;
        }

        /* Custom Input for Lottery */
        .loteria-inputs {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            justify-content: center;
        }

        .loteria-input {
            width: 120px;
            height: 50px;
            background: #f1f5f9;
            border: 2px solid transparent;
            border-radius: 12px;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            transition: all 0.2s ease;
        }

        @media (prefers-color-scheme: dark) {
            .loteria-input {
                background: #111827;
                color: #f1f5f9;
            }
        }

        .loteria-input:focus {
            border-color: #eeb425;
            background: #fff;
        }

        @media (prefers-color-scheme: dark) {
            .loteria-input:focus {
                background: #1f2937;
            }
        }

        .loteria-btn {
            background: #eeb425;
            color: #fff;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 auto;
            border-bottom: 4px solid #d9a322;
            transition: all 0.1s ease;
        }

        .loteria-btn:hover {
            transform: translateY(-1px);
        }

        .loteria-btn:active {
            transform: translateY(2px);
            border-bottom-width: 0;
        }

        .loteria-btn img {
            width: 20px;
            height: 20px;
        }

        /* Sidebar enhancements */
        @media (prefers-color-scheme: dark) {
            .sidebar-widget {
                background: rgba(31, 41, 55, 0.7) !important;
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.05) !important;
            }
        }

        .successhop {
            color: #059669;
            font-size: 15px;
            margin-top: 15px;
        }

        .errorshop {
            color: #dc2626;
            font-size: 15px;
            margin-top: 15px;
        }
    </style>
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
                        <div class="purse-widget" style="padding: 20px;">
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
    <script src="/assets/scripts/app.js"></script>
    <script>
        $().ready(function() {
            setTimeout(function() {
                $('.error').hide();
            }, 3500);
        });
    </script>
</body>

</html>