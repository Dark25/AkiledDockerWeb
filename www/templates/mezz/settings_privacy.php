<?php
$privacyS_active = 'active';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/settings_redesign-dark.css" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/settings_redesign.css" media="(prefers-color-scheme: light)">
    <title><?= $config['hotelName'] ?>: <?= $lang["TittleHader3"] ?></title>
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

        <div class="page-content-collider" style="background-color: transparent;">
            <div class="page-content-max-width">
                <div class="settings-main-container">
                    <?php include_once("includes/menu_settings.php"); ?>
                    <div class="settings-right-side">
                        <div class="settings-card">
                            <h2 class="settings-title"><?= $lang["TittleHader3"] ?></h2>
                            <p class="settings-description">Administra tus preferencias de privacidad y seguridad para controlar quién puede interactuar contigo en <?= $config['hotelName'] ?>.</p>

                            <form action="" method="POST" class="settings-form">
                                <?php User::editAkiledSettings();
                                $getUser = $dbh->prepare("SELECT * FROM users WHERE id = :id");
                                $getUser->bindParam(':id', $_SESSION['id']);
                                $getUser->execute();
                                $stats = $getUser->fetch();
                                ?>

                                <div class="settings-form-group">
                                    <label class="settings-label"><?= $lang["Sallowfriends"] ?></label>
                                    <p class="settings-description" style="margin-bottom: 10px; font-size: 14px;"><?= $lang["Sallowfriendsdesc"] ?></p>
                                    <select name="block_newfriends" class="settings-select">
                                        <option <?php if ($stats['block_newfriends'] == "1") echo 'selected'; ?> value="1">Sí</option>
                                        <option <?php if ($stats['block_newfriends'] == "0") echo 'selected'; ?> value="0">No</option>
                                    </select>
                                </div>

                                <div class="settings-form-group">
                                    <label class="settings-label"><?= $lang["Sallowtrade"] ?></label>
                                    <p class="settings-description" style="margin-bottom: 10px; font-size: 14px;"><?= $lang["Sallowtradedesc"] ?></p>
                                    <select name="accept_trading" class="settings-select">
                                        <option <?php if ($stats['accept_trading'] == "1") echo 'selected'; ?> value="1">Sí</option>
                                        <option <?php if ($stats['accept_trading'] == "0") echo 'selected'; ?> value="0">No</option>
                                    </select>
                                </div>

                                <div class="settings-form-group">
                                    <label class="settings-label"><?= $lang["Sallowonline"] ?></label>
                                    <p class="settings-description" style="margin-bottom: 10px; font-size: 14px;"><?= $lang["Sallowonlinedesc"] ?></p>
                                    <select name="hide_online" class="settings-select">
                                        <option <?php if ($stats['hide_online'] == "1") echo 'selected'; ?> value="1">Sí</option>
                                        <option <?php if ($stats['hide_online'] == "0") echo 'selected'; ?> value="0">No</option>
                                    </select>
                                </div>

                                <div class="settings-button-container">
                                    <button type="submit" name="akiledsettings" class="settings-button save-btn"><?= $lang["SettingsButton"] ?></button>
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