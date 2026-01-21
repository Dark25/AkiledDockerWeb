<?php
$news_active = 'active';

// Fetch article details if ID is provided
$articleFound = false;
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $newsId = $_GET['id'];
    $stmt = $dbh->prepare("SELECT n.*, u.look, u.username as author_name
                           FROM cms_news n
                           LEFT JOIN users u ON u.username = n.author
                           WHERE n.id = :newsid
                           LIMIT 1");
    $stmt->bindParam(':newsid', $newsId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $article = $stmt->fetch();
        $articleFound = true;
    }
}

// Default values
$authorLook = (!empty($article['look'])) ? $article['look'] : "hr-115-42.hd-190-1.ch-215-62.lg-285-64.sh-290-62";
$authorName = (!empty($article['author_name'])) ? $article['author_name'] : "Staff";
$articleImage = (!empty($article['image'])) ? $article['image'] : "/assets/images/news/default_news.png";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Theme loading is already in menu.php but we keep it here for safety or let menu.php handle it -->
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app-dark.css" media="(prefers-color-scheme: dark)">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $articleFound ? filter($article['title']) : $lang["Nnews"] ?></title>

    <style>
        /* Article Specific Styles that use Theme Classes */
        .article-view {
            padding: 0; /* Override padding for hero effect */
            overflow: hidden;
            margin-bottom: 30px;
        }

        .article-hero {
            position: relative;
            height: 350px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            padding: 40px;
        }

        .article-hero::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(0deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);
            z-index: 1;
        }

        .article-hero-content {
            position: relative;
            z-index: 2;
            width: 100%;
        }

        .article-hero-title {
            color: #fff !important;
            font-size: 40px;
            font-weight: 800;
            margin: 0;
            text-shadow: 0 2px 10px rgba(0,0,0,0.7) !important;
            line-height: 1.1;
        }

        .article-content {
            padding: 40px;
        }

        .article-lead {
            font-size: 19px;
            font-weight: 700;
            line-height: 1.6;
            margin-bottom: 30px;
            padding-left: 20px;
            border-left: 4px solid #eeb425;
            color: var(--article-text, inherit);
        }

        .article-full-text {
            font-size: 16px;
            line-height: 1.8;
            color: var(--article-secondary, inherit);
        }

        .article-full-text p {
            margin-bottom: 1.5em;
        }

        .article-meta {
            padding: 20px 40px;
            background: rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        @media (prefers-color-scheme: dark) {
            .article-meta {
                background: rgba(255,255,255,0.03);
                border-top: 1px solid rgba(255,255,255,0.05);
            }
        }

        .author-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .author-avatar {
            width: 48px;
            height: 48px;
            background: rgba(0,0,0,0.1);
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        @media (prefers-color-scheme: dark) {
            .author-avatar {
                background: rgba(255,255,255,0.05);
            }
        }

        .author-avatar img {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -40%);
            width: 90px;
            image-rendering: pixelated;
        }

        .archive-list {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .archive-link {
            display: block;
            padding: 10px 15px;
            border-radius: 8px;
            color: inherit;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .archive-link:hover {
            background: rgba(0,0,0,0.05);
            padding-left: 20px;
        }

        @media (prefers-color-scheme: dark) {
            .archive-link:hover {
                background: rgba(255,255,255,0.05);
            }
        }

        .archive-link.active {
            background: #eeb425;
            color: #fff !important;
            font-weight: 700;
        }

        .section-title {
            display: block;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 20px 0 10px 15px;
            opacity: 0.6;
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

        <?php include_once('includes/menu.php'); ?>

        <div class="page-content-collider" style="background-color: transparent; margin: 0;">
            <div class="page-content-max-width has-sidebar">

                <!-- Main Content -->
                <div class="page-content-main-column">
                    <?php if ($articleFound): ?>
                        <div class="article-view staff-card">
                            <div class="article-hero" style="background-image: url('<?= filter($articleImage) ?>')">
                                <div class="article-hero-content">
                                    <span class="article-category"><?= $lang["Nnews"] ?></span>
                                    <h1 class="article-hero-title"><?= filter($article['title']) ?></h1>
                                </div>
                            </div>

                            <div class="article-content">
                                <div class="article-lead">
                                    <?= html_entity_decode($article['shortstory']) ?>
                                </div>
                                <div class="article-full-text">
                                    <?= html_entity_decode($article['longstory']) ?>
                                </div>
                            </div>

                            <div class="article-meta">
                                <div class="author-box">
                                    <div class="author-avatar">
                                        <img src="<?= $config['AvatarURL'] ?><?= filter($authorLook) ?>&direction=2&head_direction=2&gesture=sml&headonly=0&size=b">
                                    </div>
                                    <div class="author-info">
                                        <a href="/profile/<?= filter($authorName) ?>" style="font-weight: 800; color: inherit; text-decoration: none;"><?= filter($authorName) ?></a>
                                        <div style="font-size: 12px; opacity: 0.7;"><?= date('d F, Y', $article['date']) ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="sidebar-widget" style="text-align: center; padding: 60px;">
                            <img src="/assets/images/not-found/fank_walksaway.png" style="margin-bottom: 20px;">
                            <h2 style="font-size: 24px; font-weight: 800;"><?= $lang["Nnotfoundheader"] ?></h2>
                            <p style="opacity: 0.7; margin-bottom: 30px;"><?= $lang["Nnotfoundtxt"] ?></p>
                            <a href="/me" class="enter-hotel-btn" style="display: inline-block; padding: 12px 30px;">Volver al inicio</a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="page-content-sidebar">
                    <div class="sidebar-widget">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                            <img src="/assets/images/collider/feeds.png" style="width: 24px; height: 24px;">
                            <h3 style="font-size: 16px; font-weight: 800; margin: 0;"><?= $lang["Nnews"] ?></h3>
                        </div>

                        <div class="archive-list">
                            <?php
                            $sections = [
                                ['name' => $lang["Ntoday"], 'min' => time() - 86400, 'max' => time()],
                                ['name' => $lang["Nyesterday"], 'min' => time() - 172800, 'max' => time() - 86400],
                                ['name' => $lang["Nthisweek"], 'min' => time() - 604800, 'max' => time() - 172800],
                                ['name' => $lang["Nlastweek"], 'min' => time() - 1209600, 'max' => time() - 604800],
                                ['name' => $lang["Nthismonth"], 'min' => time() - 2592000, 'max' => time() - 1209600],
                                ['name' => $lang["Nlastmonth"], 'min' => time() - 5184000, 'max' => time() - 2592000],
                            ];

                            foreach ($sections as $section) {
                                $stmt = $dbh->prepare("SELECT id, title FROM cms_news WHERE date >= :min AND date <= :max ORDER BY date DESC");
                                $stmt->bindParam(':min', $section['min']);
                                $stmt->bindParam(':max', $section['max']);
                                $stmt->execute();

                                if ($stmt->rowCount() > 0) {
                                    echo '<span class="section-title">' . filter($section['name']) . '</span>';
                                    while ($a = $stmt->fetch()) {
                                        $activeClass = (isset($_GET['id']) && $_GET['id'] == $a['id']) ? 'active' : '';
                                        echo '<a href="/articles/' . filter($a['id']) . '" class="archive-link ' . $activeClass . '">' . filter($a['title']) . '</a>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <?php if (file_exists('includes/sidebar.php')) include_once("includes/sidebar.php"); ?>
                </div>

            </div>
        </div>

        <?php if (file_exists('includes/footer.php')) include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>