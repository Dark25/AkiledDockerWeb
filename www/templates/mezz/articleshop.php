<?php
$shop_active = 'active';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/articleshop.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/articleshop-dark.css"
        media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: Tienda de Monedas</title>
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

        <?php include_once('includes/menu.php'); ?>

        <div class="page-content-collider">
            <div class="page-content-max-width has-sidebar">
                <div class="page-content-main-column">

                    <?php
                    if (isset($_POST['pack1'])) {
                        $belcr_get = $dbh->prepare("SELECT * FROM mezz_currency WHERE user_id = :userid AND id = :product_id  AND reclaim = '0' AND status_paypal LIKE 'COMPLETED'");
                        $belcr_get->bindValue(':userid', User::userData('id'));
                        $belcr_get->bindParam(':product_id', $_POST['producid']);
                        $belcr_get->execute();

                        if ($belcr_get->RowCount() > 0) {
                            if (User::userData('online') == 0) {
                                $belcr_shop = $dbh->prepare("SELECT * FROM mezz_currency WHERE user_id = :userid AND id = :product_id  AND reclaim = '0' AND status_paypal LIKE 'COMPLETED' LIMIT 1");
                                $belcr_shop->bindValue(':userid', User::userData('id'));
                                $belcr_shop->bindParam(':product_id', $_POST['producid']);
                                $belcr_shop->execute();
                                $shopidpay = $belcr_shop->fetch();

                                $updateshop = $dbh->prepare("UPDATE mezz_currency SET reclaim = '1' WHERE user_id = :userid AND reclaim = '0' AND id_paypal = :idpaypal");
                                $updateshop->bindValue(':userid', User::userData('id'));
                                $updateshop->bindParam(':idpaypal', $shopidpay["id_paypal"]);
                                $updateshop->execute();

                                $cantidadesmeraldas = $_POST['esmeraldas'];
                                $cantidadplanetas = $_POST["planetas"];
                                $updatemonedero = $dbh->prepare("UPDATE users SET activity_points = activity_points + :cantidadesmeraldas, vip_points = vip_points + :cantidadplanetas WHERE id = :userid");
                                $updatemonedero->bindParam(':cantidadesmeraldas', $cantidadesmeraldas);
                                $updatemonedero->bindParam(':cantidadplanetas', $cantidadplanetas);
                                $updatemonedero->bindValue(':userid', User::userData('id'));
                                $updatemonedero->execute();

                                echo '<div class="alert-modern success"><i class="fas fa-check-circle"></i> Compra de cofre canjeada correctamente, puedes revisar tu inventario dentro del hotel.</div>';
                            } else {
                                echo '<div class="alert-modern error"><i class="fas fa-exclamation-triangle"></i> Debes estar desconectado del hotel para poder canjearlo.</div>';
                            }
                        } else {
                            echo '<div class="alert-modern error"><i class="fas fa-times-circle"></i> Hubo un error con tu compra, por favor comunícate con el soporte técnico.</div>';
                        }
                    }

                    if (empty($_GET['id'])) {
                        ?>
                        <div class="alert-modern error">
                            <i class="fas fa-search"></i>
                            <div>
                                <strong><?= $lang["Nnotfoundheader"] ?></strong><br>
                                <?= $lang["Nnotfoundtxt"] ?>
                            </div>
                        </div>
                        <?php
                    } else {
                        if (!is_numeric($_GET['id'])) {
                            exit('Nothing!');
                        }

                        $news = $dbh->prepare("SELECT * FROM mezz_shop WHERE id = :newsid");
                        $news->bindParam(':newsid', $_GET['id']);
                        $news->execute();

                        if ($news->RowCount() == 1) {
                            $news2 = $news->fetch();
                            ?>
                            <div class="article-hero">
                                <div class="article-hero-content">
                                    <div class="article-hero-image-wrapper">
                                        <img src="<?= filter($news2["image"]) ?>" class="article-hero-image pixelated"
                                            alt="Article Image">
                                    </div>
                                    <div class="article-hero-details">
                                        <h1 class="article-hero-title"><?= filter($news2["title"]) ?></h1>
                                        <div class="article-hero-rewards">
                                            <div class="reward-badge-modern">
                                                <img src="/assets/images/shop/esmeralda.png" class="pixelated" alt="">
                                                <span><?= filter($news2["esmeraldas"]) ?> Esmeraldas</span>
                                            </div>
                                            <div class="reward-badge-modern">
                                                <img src="/assets/images/user-space/planeta.png" class="pixelated" alt="">
                                                <span><?= filter($news2["planetas"]) ?> Planetas</span>
                                            </div>
                                        </div>
                                        <div class="article-buy-container">
                                            <div class="article-price-display">
                                                <span class="price-label">Precio del Pack</span>
                                                <span class="price-value"><?= filter($news2["price"]) ?>$ USD</span>
                                            </div>
                                            <div id="paypal-button-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script
                                src="https://www.paypal.com/sdk/js?client-id=<?= $config['payclient_id']; ?>&enable-funding=venmo&currency=USD"
                                data-sdk-integration-source="button-factory"></script>
                            <script>
                                function initPayPalButton() {
                                    paypal.Buttons({
                                        style: {
                                            shape: 'rect',
                                            color: 'gold',
                                            layout: 'vertical',
                                            label: 'paypal',
                                        },
                                        createOrder: function (data, actions) {
                                            return actions.order.create({
                                                purchase_units: [{
                                                    "description": "<?= filter($news2["planetas"]); ?>",
                                                    "amount": {
                                                        "currency_code": "USD",
                                                        "value": <?= filter($news2["price"]); ?>,
                                                        "breakdown": {
                                                            "item_total": {
                                                                "currency_code": "USD",
                                                                "value": <?= filter($news2["price"]); ?>
                                                            }
                                                        }
                                                    },
                                                    "items": [{
                                                        "name": "<?= filter($news2["title"]); ?>",
                                                        "description": "<?= filter($news2["esmeraldas"]); ?>",
                                                        "unit_amount": {
                                                            "currency_code": "USD",
                                                            "value": <?= filter($news2["price"]); ?>
                                                        },
                                                        "quantity": "1"
                                                    },]
                                                }]
                                            });
                                        },
                                        onApprove: function (data, actions) {
                                            return actions.order.capture().then(function (detalles) {
                                                let url = '/shopvalidpack1'
                                                return fetch(url, {
                                                    method: 'post',
                                                    headers: {
                                                        'content-type': 'application/json'
                                                    },
                                                    body: JSON.stringify({
                                                        detalles: detalles
                                                    })
                                                }).then(function () {
                                                    const element = document.getElementById('paypal-button-container');
                                                    element.innerHTML = '<div class="alert-modern success">Compra realizada con éxito. Recarga la página para canjear tu compra.</div>';
                                                });
                                            });
                                        },
                                        onError: function (err) {
                                            console.log(err);
                                        }
                                    }).render('#paypal-button-container');
                                }
                                initPayPalButton();
                            </script>

                            <?php
                        } else {
                            ?>
                            <div class="alert-modern error">
                                <i class="fas fa-exclamation-circle"></i>
                                <div>
                                    <strong><?= $lang["NnotfoundheaderMezz"] ?></strong><br>
                                    <?= $lang["Nnotfoundtxtmezz"] ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                 
                </div>

                <?php include_once('includes/sidebar.php'); ?>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>