<?php
$emailS_active = 'active';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/settings_redesign.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $lang["TittleHader5"] ?></title>
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
            <div class="page-content-max-width">
                <div class="settings-main-container">
                    <?php include_once("includes/menu_settings.php"); ?>
                    <div class="settings-right-side">
                        <div class="settings-card">
                            <h2 class="settings-title"><?= $lang["Sconfigemail"] ?></h2>
                            <p class="settings-description"><?= $lang["Sconfigemaildesc"] ?></p>

                            <form action="" method="post" class="settings-form">
                                <?php User::editEmail(); ?>
                                <div class="settings-form-group">
                                    <label class="settings-label">Dirección de Correo Actual / Nueva</label>
                                    <input type="email" name="email" class="settings-input" placeholder="correo@ejemplo.com" value="<?= User::userData('mail') ?>">
                                </div>

                                <div class="settings-button-container">
                                    <button type="submit" name="account" class="settings-button save-btn"><?= $lang["SettingsButton"] ?></button>
                                </div>
                            </form>
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