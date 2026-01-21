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
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css" media="(prefers-color-scheme: light)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app-dark.css" media="(prefers-color-scheme: dark)">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $articleFound ? filter($article['title']) : $lang["Nnews"] ?></title>

    <style>
        /* Modern Theme Variables */
        :root {
            --article-bg: #fff;
            --article-text: #1e293b;
            --article-secondary: #475569;
            --article-muted: #64748b;
            --article-border: #f1f5f9;
            --article-footer-bg: #f8fafc;
            --archive-active-bg: #fef3c7;
            --archive-active-text: #b45309;
            --sidebar-bg: #fff;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --article-bg: #1f2937;
                --article-text: #f1f5f9;
                --article-secondary: #cbd5e1;
                --article-muted: #94a3b8;
                --article-border: rgba(255, 255, 255, 0.05);
                --article-footer-bg: rgba(0, 0, 0, 0.2);
                --archive-active-bg: rgba(251, 191, 36, 0.1);
                --archive-active-text: #fbbf24;
                --sidebar-bg: #1f2937;
                --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            }
        }

        /* Layout Fixes (Safety) */
        .page-content-max-width.has-sidebar {
            display: flex !important;
            flex-direction: row !important;
            align-items: flex-start !important;
            gap: 30px;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .page-content-main-column {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .page-content-sidebar {
            width: 350px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            flex-shrink: 0;
        }

        .sidebar-widget {
            background: var(--sidebar-bg);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--article-border);
        }

        /* Article Styles */
        .article-container {
            background: var(--article-bg);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            border: 1px solid var(--article-border);
        }

        .article-header {
            position: relative;
            height: 320px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            padding: 40px;
        }

        .article-header::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.2);
            z-index: 0;
        }

        .article-header::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(0deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.2) 100%);
            z-index: 1;
        }

        .article-header-content {
            position: relative;
            z-index: 2;
            width: 100%;
        }

        .article-category {
            background: #eeb425;
            color: #fff;
            padding: 6px 16px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 15px;
            display: inline-block;
            letter-spacing: 0.8px;
            box-shadow: 0 4px 15px rgba(238, 180, 37, 0.4);
        }

        .article-title {
            color: #fff !important;
            font-size: 42px;
            font-weight: 900;
            margin: 0;
            text-shadow: 0 2px 15px rgba(0,0,0,0.6);
            line-height: 1.1;
        }

        .article-body {
            padding: 45px;
        }

        .article-shortstory {
            font-size: 22px;
            color: var(--article-text);
            font-weight: 700;
            line-height: 1.5;
            margin-bottom: 35px;
            padding-left: 28px;
            border-left: 6px solid #eeb425;
        }

        .article-longstory {
            font-size: 17px;
            color: var(--article-secondary);
            line-height: 1.9;
        }

        .article-longstory p {
            margin-bottom: 1.6em;
            color: inherit !important;
        }

        .article-footer {
            padding: 28px 45px;
            background: var(--article-footer-bg);
            border-top: 1px solid var(--article-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .article-author {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .article-author-avatar {
            width: 64px;
            height: 64px;
            background: var(--article-border);
            border-radius: 18px;
            overflow: hidden;
            position: relative;
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }

        .article-author-avatar img {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -40%);
            width: 110px;
            image-rendering: pixelated;
        }

        .article-author-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .article-author-name {
            font-weight: 800;
            color: var(--article-text);
            font-size: 18px;
            text-decoration: none;
            transition: color 0.2s;
        }

        .article-author-name:hover {
            color: #eeb425;
        }

        .article-date {
            font-size: 13px;
            color: var(--article-muted);
            font-weight: 600;
        }

        /* Sidebar Archive Widget */
        .news-archive-widget {
            padding: 0;
        }

        .news-archive-header {
            padding: 24px 24px 10px 24px;
            border-bottom: 1px solid var(--article-border);
        }

        .archive-section-title {
            font-size: 11px;
            font-weight: 800;
            color: var(--article-muted);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin: 25px 24px 12px 24px;
            display: block;
        }

        .archive-section-title:first-of-type {
            margin-top: 15px;
        }

        .news-archive-list {
            padding: 0 14px 20px 14px;
        }

        .news-archive-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: var(--article-secondary);
            font-size: 14px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 4px;
            text-decoration: none;
        }

        .news-archive-item::before {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--article-muted);
            border-radius: 50%;
            margin-right: 12px;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .news-archive-item:hover {
            background: var(--article-border);
            color: var(--article-text);
            transform: translateX(5px);
        }

        .news-archive-item:hover::before {
            background: #eeb425;
            transform: scale(1.5);
        }

        .news-archive-item.active {
            background: var(--archive-active-bg);
            color: var(--archive-active-text);
            box-shadow: inset 0 0 0 1px rgba(238, 180, 37, 0.2);
        }

        .news-archive-item.active::before {
            background: #eeb425;
            transform: scale(1.5);
        }

        /* Error state */
        .error-container {
            text-align: center;
            padding: 100px 40px;
        }

        .error-image {
            margin-bottom: 30px;
            filter: drop-shadow(0 15px 30px rgba(0,0,0,0.3));
        }

        .error-title {
            font-size: 32px;
            font-weight: 900;
            color: var(--article-text);
            margin-bottom: 15px;
        }

        .btn-primary {
            display: inline-block;
            background: #eeb425;
            color: #fff !important;
            padding: 14px 36px;
            border-radius: 12px;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 4px 14px 0 rgba(238, 180, 37, 0.39);
            transition: all 0.3s;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px 0 rgba(238, 180, 37, 0.45);
            background: #f3be3c;
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
                        <div class="article-container">
                            <div class="article-header" style="background-image: url('<?= filter($articleImage) ?>')">
                                <div class="article-header-content">
                                    <span class="article-category"><?= $lang["Nnews"] ?></span>
                                    <h1 class="article-title"><?= filter($article['title']) ?></h1>
                                </div>
                            </div>

                            <div class="article-body">
                                <div class="article-shortstory">
                                    <?= html_entity_decode($article['shortstory']) ?>
                                </div>
                                <div class="article-longstory">
                                    <?= html_entity_decode($article['longstory']) ?>
                                </div>
                            </div>

                            <div class="article-footer">
                                <div class="article-author">
                                    <div class="article-author-avatar">
                                        <img src="<?= $config['AvatarURL'] ?><?= filter($authorLook) ?>&direction=2&head_direction=3&gesture=sml&size=m">
                                    </div>
                                    <div class="article-author-info">
                                        <a href="/profile/<?= filter($authorName) ?>" class="article-author-name"><?= filter($authorName) ?></a>
                                        <span class="article-date"><?= date('d F, Y', $article['date']) ?></span>
                                    </div>
                                </div>
                                <div class="article-share">
                                    <!-- Share logic could go here -->
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="article-container">
                            <div class="error-container">
                                <div class="error-image">
                                    <img src="/assets/images/not-found/fank_walksaway.png">
                                </div>
                                <h2 class="error-title"><?= $lang["Nnotfoundheader"] ?></h2>
                                <p class="error-text"><?= $lang["Nnotfoundtxt"] ?></p>
                                <a href="/me" class="btn-primary">Volver al inicio</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="page-content-sidebar">
                    <div class="sidebar-widget news-archive-widget">
                        <div class="news-archive-header">
                            <div class="widget-title" style="display: flex; align-items: center; gap: 12px;">
                                <img src="/assets/images/collider/feeds.png" style="width: 24px; height: 24px;">
                                <h3 style="font-size: 17px; font-weight: 800; color: var(--article-text); margin: 0;"><?= $lang["Nnews"] ?></h3>
                            </div>
                        </div>

                        <div class="news-archive-content">
                            <?php
                            // News archive sections
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
                                    echo '<span class="archive-section-title">' . filter($section['name']) . '</span>';
                                    echo '<div class="news-archive-list">';
                                    while ($a = $stmt->fetch()) {
                                        $activeClass = (isset($_GET['id']) && $_GET['id'] == $a['id']) ? 'active' : '';
                                        // Using standard URL format for this project
                                        echo '<a href="/articles/' . filter($a['id']) . '" class="news-archive-item ' . $activeClass . '">' . filter($a['title']) . '</a>';
                                    }
                                    echo '</div>';
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