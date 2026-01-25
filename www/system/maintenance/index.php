<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $config['hotelName'] ?> - <?= $lang["Mtitle"] ?></title>
    <link rel="stylesheet" href="<?= $config['hotelUrl'] ?>/system/maintenance/css/maintenance-v2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <script type="module" src="https://unpkg.com/dark-mode-toggle"></script>
</head>
<body>
    <script>
        if (localStorage.getItem('dark-mode-toggle') === 'light') {
            document.body.classList.add('light-mode');
        }
    </script>
    <div class="mesh-bg">
        <div class="mesh-ball ball-1"></div>
        <div class="mesh-ball ball-2"></div>
        <div class="mesh-ball ball-3"></div>
    </div>

    <div id="back1" class="bg-decor"></div>
    <div id="back2" class="bg-decor"></div>

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
        <div class="maintenance-tag">Mode: Maintenance</div>
        <h1><?= $config['hotelName'] ?></h1>
        <p><?= $lang["Mtitle"] ?>. Estamos trabajando para mejorar tu experiencia. ¡Volveremos pronto!</p>

        <?php if($config['twitterEnable'] == true): ?>
        <div class="twitter-container">
            <a id="twitter-widget" class="twitter-timeline" data-width="100%" data-height="300" data-theme="dark" data-chrome="noheader nofooter noborders transparent" data-link-color="#38bdf8" href="<?= $config['twitter'] ?>">Tweets by <?= $config['hotelName'] ?></a>
            <script>
                (function() {
                    const theme = localStorage.getItem('dark-mode-toggle') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                    document.getElementById('twitter-widget').setAttribute('data-theme', theme);
                })();
            </script>
            <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
        <?php endif; ?>

        <div class="box">
            <a href="adminlogin" class="staff-link">
                <?= $lang["Mstafflogin"] ?>
            </a>
        </div>

        <!-- Decorative pixels -->
        <div class="pixel-decor" style="top: 10%; left: 5%;"></div>
        <div class="pixel-decor" style="bottom: 15%; right: 10%; animation-delay: -2s;"></div>
        <div class="pixel-decor" style="top: 40%; right: 5%; animation-delay: -5s;"></div>
    </div>

    <script>
        const toggle = document.querySelector('dark-mode-toggle');
        const body = document.body;

        const updateTheme = () => {
            if (toggle.mode === 'dark') {
                body.classList.remove('light-mode');
            } else {
                body.classList.add('light-mode');
            }

            // Update twitter theme if widget exists
            const twitterIframe = document.querySelector('.twitter-timeline-rendered');
            if (twitterIframe) {
                const theme = toggle.mode === 'dark' ? 'dark' : 'light';
                twitterIframe.src = twitterIframe.src.replace(/theme=(light|dark)/, `theme=${theme}`);
            }
        };

        toggle.addEventListener('colorschemechange', updateTheme);
        window.addEventListener('DOMContentLoaded', updateTheme);
    </script>
</body>
</html>
