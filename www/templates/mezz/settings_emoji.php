<?php
$emoji_active = 'active';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/settings_redesign.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/settings_redesign-dark.css" media="(prefers-color-scheme: dark)">
    <title><?= $config['hotelName'] ?>: <?= $lang["TittleHader6"] ?></title>
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
                            <h2 class="settings-title"><?= $lang["emojititle"]; ?></h2>
                            <p class="settings-description"><?= $lang["emojidec"]; ?></p>

                            <div class="emoji-grid-scroll">
                                <form action="" method="POST">
                                    <?php User::EditEmoji(); ?>

                                    <div class="emoji-category-section">
                                        <div class="emoji-category-header">😘 Emoticonos</div>
                                        <div class="emoji-grid">
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😁"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😂"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤣"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😃"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😄"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😅"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😆"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😉"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😊"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😋"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😎"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😍"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😘"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😗"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😙"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😚"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙂"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤗"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤩"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤔"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😑"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😶"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙄"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😏"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😣"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😥"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😮"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😯"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😪"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😫"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😴"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😌"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😛"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😜"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😝"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤤"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😔"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😕"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙃"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤑"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😲"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙁"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😖"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😞"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😟"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😤"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😢"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😭"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😩"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤯"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😬"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😰"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😱"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😳"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤪"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😵"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😡"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😠"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤬"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😷"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤕"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤢"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤮"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😇"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤠"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤡"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤥"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤫"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤭"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😈"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👿"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👹"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👺"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👻"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👽"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤖"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💩"></input>
                                        </div>
                                    </div>

                                    <div class="emoji-category-section">
                                        <div class="emoji-category-header">👦 Personas</div>
                                        <div class="emoji-grid">
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👶"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👴"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👵"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👾"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍⚕️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍⚕️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍🎓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍🎓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍⚖️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍⚖️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍🌾"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍🌾"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍🍳"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍🍳"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍🔧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍🔧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍🏭"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍🏭"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍💼"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍💼"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍🔬"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍🔬"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍💻"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍💻"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍🎤"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍🎤"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍🎨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍🎨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍✈️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍✈️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍🚀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍🚀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍🚒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍🚒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👮"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👮‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👮‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🕵"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🕵️‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🕵️‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💂"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💂‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💂‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👷"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👷‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👷‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤴"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👸"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👳"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👳‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👳‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👲"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧕"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧔"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👱"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👱‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👱‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤵"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👰"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤰"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤱"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👼"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎅"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤶"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧙‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧙‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧚‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧚‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧛‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧛‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧜‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧜‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧝‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧝‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧞‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧞‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧟‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧟‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙍"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙍‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙍‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙎"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙎‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙎‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙅"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙅‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙅‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙆"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙆‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙆‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💁"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💁‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💁‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙋"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙋‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙋‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙇"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙇‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙇‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤦‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤦‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤷"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤷‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤷‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💆"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💆‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💆‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💇"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💇‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💇‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚶"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚶‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚶‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏃"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏃‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏃‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💃"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🕺"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👯"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👯‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👯‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧖‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧖‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🕴"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👤"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👥"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👫"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👬"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👭"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💏"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍❤️‍💋‍👨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍❤️‍💋‍👩"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💑"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍❤️‍👨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍❤️‍👩"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👪"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👩‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👩‍👧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👩‍👧‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👩‍👦‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👩‍👧‍👧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👨‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👨‍👧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👨‍👧‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👨‍👦‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👨‍👧‍👧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍👩‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍👩‍👧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍👩‍👧‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍👩‍👦‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍👩‍👧‍👧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👦‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👧‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👨‍👧‍👧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍👦‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍👧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍👧‍👦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👩‍👧‍👧"></input>
                                        </div>
                                    </div>

                                    <div class="emoji-category-section">
                                        <div class="emoji-category-header">😺 Animales</div>
                                        <div class="emoji-grid">
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😺"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😸"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😹"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😻"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😼"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😽"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😿"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="😾"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙈"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙉"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙊"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💥"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐵"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦍"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐶"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐕"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐩"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐺"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦊"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐱"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐈"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦁"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐯"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐅"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐆"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐴"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐎"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦄"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐮"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐂"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐃"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐄"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐷"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐖"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐗"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐽"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐏"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐑"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐪"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐫"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐘"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦏"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐭"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐁"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐹"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐰"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐇"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦔"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦇"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐻"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐼"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐾"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦃"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐔"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐣"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐤"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐥"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦅"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦆"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦉"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐸"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐊"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐢"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦎"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐍"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐲"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐉"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦕"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦖"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐳"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐋"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐬"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐟"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐠"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐡"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦈"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐙"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐚"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦑"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐌"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦋"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐛"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐜"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐝"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🐞"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦗"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🦂"></input>
                                        </div>
                                    </div>

                                    <div class="emoji-category-section">
                                        <div class="emoji-category-header">💐 Flores</div>
                                        <div class="emoji-grid">
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌸"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💮"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌹"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌺"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌻"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌼"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌷"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌱"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌲"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌳"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌴"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌵"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌾"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌿"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍁"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍂"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍃"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍄"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌰"></input>
                                        </div>
                                    </div>

                                    <div class="emoji-category-section">
                                        <div class="emoji-category-header">🌍 Mundo</div>
                                        <div class="emoji-grid">
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌍"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌎"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌏"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌑"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌔"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌕"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌖"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌗"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌘"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌙"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌚"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌛"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌜"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌝"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌞"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⭐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌟"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌠"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="☁"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⛅"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌈"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="☔"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⚡"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⛄"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🔥"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌊"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎄"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="✨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎋"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎍"></input>
                                        </div>
                                    </div>

                                    <div class="emoji-category-section">
                                        <div class="emoji-category-header">🍔 Comida</div>
                                        <div class="emoji-grid">
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍇"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍈"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍉"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍊"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍋"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍌"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍍"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍎"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍏"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍑"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥝"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍅"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥥"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥑"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍆"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥔"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥕"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌽"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥜"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍞"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥖"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥞"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍖"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍗"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥩"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍔"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍟"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍕"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌭"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥪"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌮"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌯"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍳"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍲"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥣"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥗"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍿"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥫"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍱"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍘"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍙"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍚"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍛"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍜"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍝"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍠"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍢"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍣"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍤"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍥"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍡"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥟"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥠"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥡"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍩"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍪"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎂"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍰"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍫"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍬"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍭"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍮"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍯"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍼"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥛"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="☕"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍵"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍶"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍾"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍷"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍸"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍹"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍺"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍻"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥂"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥃"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥤"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥢"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🍴"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥄"></input>
                                        </div>
                                    </div>

                                    <div class="emoji-category-section">
                                        <div class="emoji-category-header">🏇 Deportes</div>
                                        <div class="emoji-grid">
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏇"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏂"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧗‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧗‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧘‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧘‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏌"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏌️‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏌️‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏄"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏄‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏄‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚣"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚣‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚣‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏊"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏊‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏊‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⛹"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⛹️‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⛹️‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏋"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏋️‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏋️‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚴"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚴‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚴‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚵"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚵‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚵‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤸"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤸‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤸‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤼"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤼‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤼‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤽"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤽‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤽‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤾"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤾‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤾‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤹"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤹‍♂️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤹‍♀️"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎪"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎫"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏆"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏅"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥇"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥈"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥉"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⚽"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⚾"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏈"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏉"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎾"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎳"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏏"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏑"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏸"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥊"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥋"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⛳"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⛸"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎣"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎽"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎿"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🛷"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥌"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎯"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎱"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎮"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎰"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎲"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎭"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎼"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎤"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎷"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎸"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎹"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎺"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎻"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🥁"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎬"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏹"></input>
                                        </div>
                                    </div>

                                    <div class="emoji-category-section">
                                        <div class="emoji-category-header">🗼 Lugares y Viajes</div>
                                        <div class="emoji-grid">
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🗾"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌋"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🗻"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏠"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏡"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏢"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏣"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏤"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏥"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏩"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏪"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏫"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏬"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏭"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏯"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏰"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🗼"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🗽"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⛪"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🕌"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🕍"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🕋"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⛲"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⛺"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌁"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌃"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌄"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌅"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌆"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌇"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌉"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌌"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎠"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎡"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎢"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚂"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚃"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚄"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚅"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚆"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚇"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚈"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚉"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚊"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚝"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚞"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚋"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚌"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚍"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚎"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚑"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚔"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚕"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚖"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚗"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚘"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚚"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚛"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚜"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚲"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🛴"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🛵"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚏"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⛽"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⛵"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚤"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚢"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🛫"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🛬"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💺"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚁"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚟"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚠"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚡"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🛸"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎆"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎇"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎑"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🗿"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🛂"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🛃"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🛄"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🛅"></input>
                                        </div>
                                    </div>

                                    <div class="emoji-category-section">
                                        <div class="emoji-category-header">💎 Objetos</div>
                                        <div class="emoji-grid">
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💎"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👔"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👕"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👖"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧣"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧤"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧥"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👗"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👘"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👙"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👚"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👛"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👜"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👝"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👞"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👟"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👠"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👡"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👢"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👑"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎩"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🧢"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💄"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💍"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🌂"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💼"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🛀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🛌"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💌"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💣"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚥"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚧"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⚓"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📿"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🔪"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🏺"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💈"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🛢"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⌛"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⏳"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⌚"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⏰"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⏱"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="⏲"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎈"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎉"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎊"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎎"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎏"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎀"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎁"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🔮"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📻"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📱"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="☎"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📞"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🔋"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🔌"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💻"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💽"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💿"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🎥"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📺"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📷"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📹"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🔎"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📗"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📘"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📙"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📚"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📃"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📁"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📅"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📆"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="📏"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🔒"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🔨"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🔫"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚪"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🚬"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💘"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💔"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💕"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💖"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💗"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💙"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💚"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💛"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💝"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💦"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💨"></input>
                                        </div>
                                    </div>

                                    <div class="emoji-category-section">
                                        <div class="emoji-category-header">🖕 Señas</div>
                                        <div class="emoji-grid">
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👍"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👎"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💪"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤳"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👉"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="☝"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🖕"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👇"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="✌"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤞"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🖖"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤘"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🖐"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👌"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👊"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤜"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤛"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🤚"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👋"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="✍"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👏"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="🙏"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👂"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👃"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👅"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="👄"></input>
                                            <input class="emojibox-modern" type="submit" name="emojiuser" value="💋"></input>
                                        </div>
                                    </div>
                                </form>
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