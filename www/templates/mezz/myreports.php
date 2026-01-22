<?php
$report_active = 'active';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <link rel="stylesheet" href="/assets/styles/help.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" href="/assets/styles/help-dark.css" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $lang["ReportePage"] ?></title>
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
            <div class="page-content-max-width has-sidebar">
                <div class="page-content-main-column">
                    <div class="help-main-card">
                        <?php include_once("report/getReports.php"); ?>
                    </div>
                </div>

                <div class="page-content-sidebar">
                    <div class="help-side-card">
                        <div class="help-side-card-header">
                            <h3 class="help-side-card-title"><i class="fas fa-file-alt mr-2"></i> Reports</h3>
                        </div>
                        <div class="help-side-card-body">
                            <?php include_once("report/ListMyReports.php"); ?>
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