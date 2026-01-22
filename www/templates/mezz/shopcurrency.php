<?php
$shop_active = 'active';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/shopcurrency.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/shopcurrency-dark.css" media="(prefers-color-scheme: dark)">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

                    <?php
                    if (isset($_POST['pack1'])) {
                        $belcr_get = $dbh->prepare("SELECT * FROM mezz_currency WHERE user_id = :userid AND id = :product_id  AND reclaim = '0' AND status_paypal LIKE 'COMPLETED'");
                        $belcr_get->bindParam(':userid', User::userData('id'));
                        $belcr_get->bindParam(':product_id', $_POST['producid']);
                        $belcr_get->execute();

                        if ($belcr_get->RowCount() > 0) {
                            if (User::userData('online') == 0) {
                                $belcr_shop = $dbh->prepare("SELECT * FROM mezz_currency WHERE user_id = :userid AND id = :product_id  AND reclaim = '0' AND status_paypal LIKE 'COMPLETED' LIMIT 1");
                                $belcr_shop->bindParam(':userid', User::userData('id'));
                                $belcr_shop->bindParam(':product_id', $_POST['producid']);
                                $belcr_shop->execute();
                                $shopidpay = $belcr_shop->fetch();

                                $updateshop = $dbh->prepare("UPDATE mezz_currency SET reclaim = '1' WHERE user_id = :userid AND reclaim = '0' AND id_paypal = :idpaypal");
                                $updateshop->bindParam(':userid', User::userData('id'));
                                $updateshop->bindParam(':idpaypal', $shopidpay["id_paypal"]);
                                $updateshop->execute();

                                $cantidadesmeraldas = $_POST['esmeraldas'];
                                $cantidadplanetas = $_POST["planetas"];
                                $updatemonedero = $dbh->prepare("UPDATE users SET activity_points = activity_points + :cantidadesmeraldas, vip_points = vip_points + :cantidadplanetas WHERE id = :userid");
                                $updatemonedero->bindParam(':cantidadesmeraldas', $cantidadesmeraldas);
                                $updatemonedero->bindParam(':cantidadplanetas', $cantidadplanetas);
                                $updatemonedero->bindParam(':userid', User::userData('id'));
                                $updatemonedero->execute();

                                echo '<div class="alert-modern success">Compra de cofre canjeada correctamente, puedes revisar tu inventario dentro del hotel.</div>';
                            } else {
                                user::RCON();
                    ?>
                                <form method="POST" id="RCON" action="" name="RCON">
                                    <input type="hidden" name="userid" value="<?= User::userData('id') ?>" />
                                    <input type="hidden" name="currency" value="esmeraldas" />
                                    <input type="hidden" name="cantidad" value="<?= $_POST['esmeraldas'] ?>" />
                                </form>

                                <script type="text/javascript">
                                    document.getElementById("RCON").submit();
                                </script>
                    <?php
                            }
                        } else {
                            echo '<div class="alert-modern error">Hubo un error con tu compra, por favor comunícate con el soporte técnico del hotel.</div>';
                        }
                    }
                    ?>

                    <div class="currency-header">
                        <div class="currency-header-content">
                            <h1 class="currency-header-title">Tienda de Monedas</h1>
                            <p class="currency-header-subtitle">¡Potencia tu experiencia en <?= $config['hotelName'] ?> con nuestros exclusivos packs de esmeraldas y planetas!</p>
                        </div>
                        <img src="/assets/images/fondos/cofre3.png" class="currency-header-image" alt="Shop Icon">
                    </div>

                    <div class="shop-section">
                        <?php include_once("get/getshop.php"); ?>
                    </div>

                    <div class="chests-section">
                        <div class="section-title">
                            <img src="/assets/images/collider/rooms.png" class="pixelated" alt="">
                            Cofres Disponibles
                        </div>

                        <div class="chests-grid">
                            <?php
                            $belcr_get = $dbh->prepare("SELECT * FROM mezz_currency WHERE user_id = :userid AND reclaim = '0'");
                            $belcr_get->bindParam(':userid', User::userData('id'));
                            $belcr_get->execute();

                            if ($belcr_get->RowCount() > 0) {
                                while ($consuloro = $belcr_get->fetch()) { ?>
                                    <div class="chest-card">
                                        <div class="chest-image-bg">
                                            <img src="/assets/images/fondos/cofre3.png" class="chest-image pixelated" alt="Chest">
                                        </div>
                                        <h4 class="chest-title"><?= filter($consuloro['product']) ?></h4>
                                        <div class="chest-badge">Disponible</div>

                                        <form method="post" action="">
                                            <input type="hidden" name="planetas" value="<?= $consuloro['planetas'] ?>" />
                                            <input type="hidden" name="esmeraldas" value="<?= $consuloro['esmeraldas'] ?>" />
                                            <input type="hidden" name="producto" value="<?= $consuloro['product'] ?>" />
                                            <input type="hidden" name="producid" value="<?= $consuloro['id'] ?>" />
                                            <button type="submit" name="pack1" class="chest-redeem-btn">Canjear ahora</button>
                                        </form>
                                    </div>
                                <?php
                                }
                            } else {
                                echo '<p class="no-chests-text">' . $lang["Nnotfoundtxtmezz2"] . '</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="page-content-sidebar">
                    <div class="purse-widget-modern">
                        <h3 class="purse-title">
                            <img src="/assets/images/shop/credits.png" class="pixelated" alt="">
                            <?= $lang["MyPurse"] ?>
                        </h3>
                        <div class="purse-items-container">
                            <div class="purse-item-modern credits">
                                <img src="/assets/images/shop/credits.png" alt="Monedas" class="purse-icon-modern pixelated">
                                <div class="purse-info-modern">
                                    <span class="purse-value-modern"><?= number_format(User::userData('credits')) ?></span>
                                    <span class="purse-label-modern">Créditos</span>
                                </div>
                            </div>
                            <div class="purse-item-modern esmeraldas">
                                <img src="/assets/images/shop/esmeralda.png" alt="Esmeraldas" class="purse-icon-modern pixelated">
                                <div class="purse-info-modern">
                                    <span class="purse-value-modern"><?= number_format(User::userData('activity_points')) ?></span>
                                    <span class="purse-label-modern">Esmeraldas</span>
                                </div>
                            </div>
                            <div class="purse-item-modern planetas">
                                <img src="/assets/images/user-space/planeta.png" alt="Planetas" class="purse-icon-modern pixelated">
                                <div class="purse-info-modern">
                                    <span class="purse-value-modern"><?= number_format(User::userData('vip_points')) ?></span>
                                    <span class="purse-label-modern">Planetas</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <h3 class="purse-title"><?= $lang["HelpPay"] ?></h3>
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
</body>

</html>
