<?php
$profile_active = 'active';
$menu = "me";

if (empty($_GET['user'])) {
    header("Location:/");
}

$news = $dbh->prepare("SELECT * FROM users WHERE username = :name");
$news->bindParam(':name', $_GET['user']);
$news->execute();
if ($news->RowCount() == 0) {
    header("Location:/");
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Perfil de: <?= userHome('username'); ?></title>
    <style>
        :root {
            --profile-bg: #eaf2f5;
            --card-bg: #ffffff;
            --text-main: #1c1e21;
            --text-secondary: #65676b;
            --accent: #1877f2;
            --border-color: #dddfe2;
            --shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
            --stats-bg: #f8f9fa;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --profile-bg: #1d232f;
                --card-bg: #2c3444;
                --text-main: #e4e6eb;
                --text-secondary: #b0b3b8;
                --accent: #4dabf7;
                --border-color: #3e4b61;
                --shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
                --stats-bg: #232a37;
            }
        }

        .profile-container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-header {
            position: relative;
            background: var(--card-bg);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }

        .profile-cover {
            height: 200px;
            background: linear-gradient(135deg, var(--accent), #6a11cb);
            background-image: url('/assets/images/header/default-background.png');
            background-size: cover;
            background-position: center;
        }

        .profile-info {
            display: flex;
            align-items: flex-end;
            padding: 0 30px 20px;
            margin-top: -60px;
        }

        .profile-avatar-wrapper {
            background: var(--card-bg);
            padding: 5px;
            border-radius: 50%;
            box-shadow: var(--shadow);
            z-index: 2;
        }

        .profile-avatar-img {
            width: 120px;
            height: 120px;
            background: #eee;
            border-radius: 50%;
            display: block;
            object-fit: none;
            object-position: center -20px;
        }

        .profile-details {
            margin-left: 20px;
            margin-bottom: 10px;
            flex-grow: 1;
        }

        .profile-username {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-motto {
            font-size: 16px;
            color: var(--text-secondary);
            margin: 5px 0 0;
            font-style: italic;
        }

        .profile-stats-row {
            display: flex;
            gap: 15px;
            padding: 20px 30px;
            background: var(--stats-bg);
            border-top: 1px solid var(--border-color);
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--card-bg);
            padding: 10px 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            flex: 1;
        }

        .stat-card img {
            width: 24px;
            height: 24px;
        }

        .stat-info {
            display: flex;
            flex-direction: column;
        }

        .stat-value {
            font-weight: 700;
            color: var(--text-main);
            font-size: 14px;
        }

        .stat-label {
            font-size: 11px;
            color: var(--text-secondary);
            text-transform: uppercase;
        }

        .profile-content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        @media (max-width: 900px) {
            .profile-content-grid {
                grid-template-columns: 1fr;
            }
        }

        .profile-section {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--profile-bg);
            padding-bottom: 10px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-main);
            margin: 0;
        }

        /* Override existing component styles to fit the new design */
        .page-content-collider-content-profile-card-wrapper-aligner-content-title {
            display: none !important; /* We use our own titles */
        }

        .page-content-collider-content-profile-card-wrapper-aligner-content {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 0 !important;
        }

        .page-content-collider-content-profile-card-wrapper-aligner-content-badge {
            margin: 0 !important;
            padding: 5px !important;
            background: var(--stats-bg);
            border-radius: 8px;
            transition: transform 0.2s;
        }

        .page-content-collider-content-profile-card-wrapper-aligner-content-badge:hover {
            transform: scale(1.1);
        }

        .page-content-collider-content-profile-card-wrapper-aligner-content-friend {
            width: 80px;
            text-align: center;
            background: var(--stats-bg);
            border-radius: 10px;
            padding: 10px 5px;
            transition: background 0.2s;
        }

        .page-content-collider-content-profile-card-wrapper-aligner-content-friend:hover {
            background: var(--border-color);
        }

        .page-content-collider-content-profile-card-wrapper-aligner-content-friend-figure {
            width: 50px !important;
            height: 50px !important;
            object-fit: none;
            object-position: center -15px;
            margin-bottom: 5px;
        }

        .page-content-collider-content-profile-card-wrapper-aligner-content-friend-username {
            font-size: 11px;
            color: var(--text-main);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 0;
        }

        .page-content-collider-content-profile-card-wrapper-aligner-content-room {
            display: flex;
            align-items: center;
            gap: 15px;
            width: 100%;
            background: var(--stats-bg);
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .page-content-collider-content-profile-card-wrapper-aligner-content-room-image {
            width: 40px;
            height: 40px;
        }

        .page-content-collider-content-profile-card-wrapper-aligner-content-room-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-main);
            margin: 0 !important;
        }

        .photos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .page-content-collider-content-profile-photos-title {
            display: none;
        }

        .page-content-collider-content-profile-photo {
            width: 100% !important;
            height: 150px !important;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .page-content-collider-content-profile-photo-promo {
            width: 100% !important;
            height: 100% !important;
            background-size: cover !important;
            background-position: center !important;
            display: block;
        }

        .profile-footer-info {
            text-align: center;
            color: var(--text-secondary);
            font-size: 13px;
            margin-top: 40px;
            padding-bottom: 20px;
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

        <div class="profile-container">
            <!-- Header Section -->
            <div class="profile-header">
                <div class="profile-cover"></div>
                <div class="profile-info">
                    <div class="profile-avatar-wrapper">
                        <img src="<?php echo $config['AvatarURL']; ?><?= userHome('look'); ?>&direction=2&head_direction=3&gesture=sml&action=wav&size=l"
                             alt="<?= filter(userHome('username')); ?>"
                             class="profile-avatar-img">
                    </div>
                    <div class="profile-details">
                        <h1 class="profile-username"><?= filter(userHome('username')); ?></h1>
                        <p class="profile-motto"><?= filter(userHome('motto')); ?></p>
                    </div>
                </div>

                <div class="profile-stats-row">
                    <div class="stat-card">
                        <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/credits.png'>
                        <div class="stat-info">
                            <span class="stat-value"><?= number_format(userHome('credits')); ?></span>
                            <span class="stat-label">Créditos</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/planeta.png'>
                        <div class="stat-info">
                            <span class="stat-value"><?= number_format(userHome('activity_points')); ?></span>
                            <span class="stat-label">Planetas</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <img src='/templates/<?= $config["skin"]; ?>/assets/images/user-space/esmeralda.png'>
                        <div class="stat-info">
                            <span class="stat-value"><?= number_format(userHome('vip_points')); ?></span>
                            <span class="stat-label">Esmeraldas</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-content-grid">
                <!-- Left Column -->
                <div class="profile-main-content">
                    <div class="profile-section">
                        <div class="section-header">
                            <h2 class="section-title">Placas Recientes</h2>
                        </div>
                        <?php include_once("get/profile/homeBadges.php"); ?>
                    </div>

                    <div class="profile-section">
                        <div class="section-header">
                            <h2 class="section-title">Grupos</h2>
                        </div>
                        <?php include_once("get/profile/homeGroups.php"); ?>
                    </div>

                    <div class="profile-section">
                        <div class="section-header">
                            <h2 class="section-title">Galería de Fotos</h2>
                        </div>
                        <div class="photos-grid">
                            <?php include_once("get/profile/homePhotos.php"); ?>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="profile-sidebar">
                    <div class="profile-section">
                        <div class="section-header">
                            <h2 class="section-title">Amigos</h2>
                        </div>
                        <?php include_once("get/profile/homeFriends.php"); ?>
                    </div>

                    <div class="profile-section">
                        <div class="section-header">
                            <h2 class="section-title">Habitaciones</h2>
                        </div>
                        <?php include_once("get/profile/homeRooms.php"); ?>
                    </div>
                </div>
            </div>

            <div class="profile-footer-info">
                Unido a <?= $config['hotelName'] ?> en <?= date('d-m-Y', userHome('account_created')); ?>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="/assets/scripts/app.js"></script>
    </div>
</body>

</html>
