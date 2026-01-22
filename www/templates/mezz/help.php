<?php
$report_active = 'active';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>:  <?= $lang["TittleHader12"] ?></title>
    <style>
        .help-hero {
            background: linear-gradient(135deg, #eeb425 0%, #d49a00 100%);
            border-radius: 10px;
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            color: white;
            box-shadow: 0 4px 15px rgba(238, 180, 37, 0.3);
            width: 100%;
        }

        .help-hero-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            color: white;
        }

        .help-hero-subtitle {
            font-size: 18px;
            opacity: 0.9;
        }

        .help-hero-icon {
            width: 80px;
            height: 80px;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        }

        .help-body {
            display: flex;
            gap: 30px;
            width: 100%;
        }

        .help-main-content {
            flex: 1;
        }

        .help-side-content {
            width: 350px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .help-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .help-card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
        }

        .help-link {
            display: block;
            padding: 10px 15px;
            margin-bottom: 8px;
            background-color: #f8f9fa;
            border-radius: 5px;
            color: #555;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .help-link:hover {
            background-color: #eeb425;
            color: white;
            transform: translateX(5px);
        }

        .mt-20 { margin-top: 20px; }

        /* Dark Mode overrides */
        @media (prefers-color-scheme: dark) {
            .help-card {
                background-color: #111827;
                border-color: rgba(255,255,255,0.05);
                box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            }
            .help-card-title {
                color: #e5e7eb;
                border-bottom-color: #1f2937;
            }
            .help-link {
                background-color: #1f2937;
                color: #9ca3af;
            }
            .help-link:hover {
                background-color: #eeb425;
                color: white;
            }
        }

        @media (max-width: 1000px) {
            .help-body {
                flex-direction: column;
            }
            .help-side-content {
                width: 100%;
            }
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
        <div class="page-content-collider" style="background-color: transparent;">
            <div class="page-content-max-width" style="flex-direction: column;">

                <div class="help-hero">
                    <div class="help-hero-content">
                        <h1 class="help-hero-title">Centro de Ayuda</h1>
                        <p class="help-hero-subtitle">¿Tienes algún problema? Nuestro equipo está aquí para apoyarte.</p>
                    </div>
                    <img src="/assets/images/collider/feeds.png" class="help-hero-icon">
                </div>

                <div class="help-body">
                    <div class="help-main-content">
                        <?php include_once("report/sendReport.php"); ?>
                    </div>
                    <div class="help-side-content">
                        <div class="help-card">
                            <h3 class="help-card-title">Mis Informes</h3>
                            <div class="help-card-body">
                                <?php include_once("report/ListMyReports.php"); ?>
                            </div>
                        </div>

                        <div class="help-card">
                            <h3 class="help-card-title">Otros enlaces</h3>
                            <div class="help-card-body">
                                <a href="/safety/habbo-way" class="help-link">La Manera de <?= $config['hotelName'] ?></a>
                                <a href="/safety/safety" class="help-link">Consejos de Seguridad</a>
                                <a href="/safety/how-to-play" class="help-link">Preguntas Frecuentes</a>
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
