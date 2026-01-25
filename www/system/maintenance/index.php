<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $config['hotelName'] ?> - <?= $lang["Mtitle"] ?></title>
    <link rel="stylesheet" href="<?= $config['hotelUrl'] ?>/system/maintenance/css/maintenance-v2.css">
</head>
<body>
    <div id="background-images">
        <div id="back1" class="bg-image"></div>
        <div id="back2" class="bg-image"></div>
    </div>

    <div class="theme-toggle">
        <dark-mode-toggle
            id="dark-mode-toggle"
            appearance="toggle"
            dark="Oscuro"
            light="Claro"
            permanent="true">
        </dark-mode-toggle>
    </div>

    <div class="container">
        <h1><?= $config['hotelName'] ?></h1>
        <p><?= $lang["Mtitle"] ?></p>

        <?php if($config['twitterEnable'] == true): ?>
        <div class="twitter-container">
            <a class="twitter-timeline" data-width="100%" data-height="300" data-theme="light" data-link-color="#FAB81E" href="<?= $config['twitter'] ?>">Tweets by <?= $config['hotelName'] ?></a>
            <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
        <?php endif; ?>

        <div class="box">
            <a href="adminlogin" class="staff-link">
                <?= $lang["Mstafflogin"] ?>
            </a>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/dark-mode-toggle"></script>
    <script>
        const toggle = document.querySelector('dark-mode-toggle');
        const body = document.body;

        // Set initial state
        if (toggle.mode === 'dark') {
            body.classList.add('dark-mode');
        } else {
            body.classList.add('light-mode');
        }

        // Listen for changes
        toggle.addEventListener('colorschemechange', () => {
            if (toggle.mode === 'dark') {
                body.classList.add('dark-mode');
                body.classList.remove('light-mode');
            } else {
                body.classList.remove('dark-mode');
                body.classList.add('light-mode');
            }
        });
    </script>
</body>
</html>
