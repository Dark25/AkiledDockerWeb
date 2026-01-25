<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $config['hotelName'] ?> - Staff Login</title>
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
        <h1>Staff Login</h1>
        <?php User::Login(); ?>

        <form method="post">
            <input type="text" id="username" name="username" placeholder="<?= $lang['Iusername'] ?>" required>
            <input type="password" id="password" name="password" placeholder="<?= $lang['Ipassword'] ?>" required>
            <button type="submit" class="submit" name="login">
                <?= $lang["Ilogin"] ?>
            </button>
        </form>

        <div class="box">
            <a href="index" class="staff-link">
                ← Volver
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
