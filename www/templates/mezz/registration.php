<html lang="en">
<style>
    .error {
        text-align: center;
        font-size: 15px;
        background: #f44336;
        display: none;
        width: 100%;
        color: #fff;
        padding: 0 10px;
        border-radius: 2px;
        line-height: 40px;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/styles/app.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/registration-redesign.css" mwedia="(prefers-color-scheme: light)">
    <link rel="stylesheet" type="text/css" href="assets/styles/registration-redesign-dark.css" media="(prefers-color-scheme: dark)">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <title><?= $lang["Rtittle"]; ?> - <?= $lang["NameHotel"]; ?></title>
</head>
<span class="error" id="top"></span>

<body class="registration-body">
    <script src="/assets/scripts/page-load.js"></script>
    <?php
    $security = rand(100000, 900000);
    ?>
    <div class="registration-split-wrapper">
        <!-- Left Side: Immersive Hero -->
        <div class="registration-hero">
            <div class="hero-content-inner">
                <h1 class="hero-title"><?= $lang["NameHotel"]; ?></h1>
                <p class="hero-description"><?= $lang["Idesclogin"]; ?></p>
                <div class="hero-avatar-showcase">
                    <!-- This will be styled in CSS -->
                </div>
            </div>
            <div class="hero-background-overlay"></div>
        </div>

        <!-- Right Side: Clean Form -->
        <div class="registration-form-container">
            <div class="form-scroll-area">
                <?php User::Register(); ?>
                <?php User::Login(); ?>
                <div class="form-header-minimal">
                     <a href="/" class="back-link">← <?= $lang["Minicio"]; ?></a>
                     <div class="theme-toggle-minimal">
                        <dark-mode-toggle
                            id="dark-mode-toggle-reg"
                            appearance="toggle"
                            dark="Dark"
                            light="Light"
                            permanent="true">
                        </dark-mode-toggle>
                     </div>
                </div>

                <div class="registration-form-card">
                    <h2 class="form-title"><?= $lang["Rtitulos"]; ?></h2>
                    <?php include_once("auth/register.php"); ?>

            <footer class="minimal-footer">
                &copy; <?= date("Y"); ?> <?= $config['hotelName']; ?> Hotel.
            </footer>
        </div>
    </div>

    <script src="/assets/scripts/app.js"></script>
    <script type="module" src="https://unpkg.com/dark-mode-toggle"></script>
    <script>
        const toggle = document.querySelector('dark-mode-toggle');
        const body = document.body;

        // Set initial state
        if (toggle.mode === 'dark') {
            body.classList.add('dark-mode');
        }

        // Listen for changes
        toggle.addEventListener('colorschemechange', () => {
            if (toggle.mode === 'dark') {
                body.classList.add('dark-mode');
            } else {
                body.classList.remove('dark-mode');
            }
        });
    </script>
</body>

</html>