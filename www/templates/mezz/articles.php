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

// If no article found, get the latest one
if (!$articleFound) {
    $stmt = $dbh->prepare("SELECT n.*, u.look, u.username as author_name
                           FROM cms_news n
                           LEFT JOIN users u ON u.username = n.author
                           ORDER BY n.date DESC
                           LIMIT 1");
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

// Estimate reading time
$wordCount = str_word_count(strip_tags($article['longstory'] ?? ''));
$readingTime = ceil($wordCount / 200);
if ($readingTime < 1) $readingTime = 1;
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
        :root {
            --accent-color: #eeb425;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: rgba(0,0,0,0.06);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --card-bg: #1f2937;
                --text-main: #f1f5f9;
                --text-muted: #94a3b8;
                --border-color: rgba(255,255,255,0.05);
            }
        }

        .news-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
        }

        /* Breadcrumbs */
        .breadcrumbs {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 5px;
            animation: fadeInDown 0.5s ease-out;
        }

        .breadcrumbs a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumbs a:hover {
            color: var(--accent-color);
        }

        .breadcrumbs span {
            opacity: 0.5;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Article Card */
        .article-card {
            background: var(--card-bg);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .article-hero {
            position: relative;
            height: 280px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
        }

        .article-hero::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0; top: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 60%);
        }

        .article-hero-overlay {
            position: relative;
            z-index: 2;
            padding: 30px 40px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .article-title-box h1 {
            color: #fff !important;
            font-size: 32px;
            font-weight: 800;
            margin: 0;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }

        .article-category-badge {
            background: var(--accent-color);
            color: #fff;
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .article-body {
            padding: 40px;
        }

        .article-lead-text {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-main);
            line-height: 1.6;
            margin-bottom: 25px;
            padding-left: 20px;
            border-left: 4px solid var(--accent-color);
        }

        .article-main-text {
            font-size: 15px;
            line-height: 1.8;
            color: var(--text-muted);
        }

        .article-main-text p {
            margin-bottom: 1.5rem;
        }

        .article-main-text img {
            max-width: 100%;
            border-radius: 12px;
            margin: 10px 0;
        }

        /* Footer Meta */
        .article-footer {
            padding: 25px 40px;
            background: rgba(0,0,0,0.02);
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        @media (prefers-color-scheme: dark) {
            .article-footer {
                background: rgba(255,255,255,0.02);
            }
        }

        .author-info-box {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .author-avatar-circle {
            width: 50px;
            height: 50px;
            background: rgba(0,0,0,0.05);
            border-radius: 50%;
            position: relative;
            overflow: hidden;
            border: 2px solid var(--accent-color);
        }

        .author-avatar-circle img {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -40%);
            width: 100px;
        }

        .author-details a {
            display: block;
            font-weight: 700;
            color: var(--text-main);
            text-decoration: none;
            font-size: 15px;
        }

        .author-details span {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Archive Widget */
        .archive-widget {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .archive-section-label {
            font-size: 11px;
            font-weight: 800;
            color: var(--accent-color);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-top: 10px;
            padding-left: 5px;
        }

        .archive-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .archive-item:hover {
            background: rgba(238, 180, 37, 0.05);
            border-color: rgba(238, 180, 37, 0.1);
            transform: translateX(5px);
        }

        .archive-item.active {
            background: var(--accent-color);
        }

        .archive-item.active * {
            color: #fff !important;
        }

        .archive-icon {
            width: 36px;
            height: 36px;
            background: rgba(0,0,0,0.05);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        @media (prefers-color-scheme: dark) {
            .archive-icon {
                background: rgba(255,255,255,0.05);
            }
        }

        .archive-item-info {
            flex: 1;
            min-width: 0;
        }

        .archive-item-title {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Related News */
        .related-news {
            margin-top: 30px;
        }

        .related-news-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        .related-card {
            background: var(--card-bg);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            transition: transform 0.3s;
            text-decoration: none;
        }

        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .related-thumb {
            height: 120px;
            background-size: cover;
            background-position: center;
        }

        .related-info {
            padding: 15px;
        }

        .related-card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-main);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
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

        <div class="page-content-collider" style="background-color: transparent; margin: 30px 0;">
            <div class="page-content-max-width has-sidebar">

                <!-- Main Content -->
                <div class="page-content-main-column">
                    <div class="news-container">

                        <!-- Breadcrumbs -->
                        <div class="breadcrumbs">
                            <a href="/me"><?= $lang["Minicio"] ?></a>
                            <span>/</span>
                            <a href="/articles"><?= $lang["Nnews"] ?></a>
                            <?php if ($articleFound): ?>
                                <span>/</span>
                                <span style="color: var(--accent-color);"><?= filter($article['title']) ?></span>
                            <?php endif; ?>
                        </div>

                        <?php if ($articleFound): ?>
                            <article class="article-card">
                                <div class="article-hero" style="background-image: url('<?= filter($articleImage) ?>')">
                                    <div class="article-hero-overlay">
                                        <div class="article-title-box">
                                            <span class="article-category-badge"><?= $lang["Nnews"] ?></span>
                                            <h1><?= filter($article['title']) ?></h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="article-body">
                                    <div class="article-lead-text">
                                        <?= html_entity_decode($article['shortstory']) ?>
                                    </div>
                                    <div class="article-main-text">
                                        <?= html_entity_decode($article['longstory']) ?>
                                    </div>
                                </div>

                                <div class="article-footer">
                                    <div class="author-info-box">
                                        <div class="author-avatar-circle">
                                            <img src="<?= $config['AvatarURL'] ?><?= filter($authorLook) ?>&direction=2&head_direction=2&gesture=sml&headonly=0&size=b">
                                        </div>
                                        <div class="author-details">
                                            <a href="/profile/<?= filter($authorName) ?>"><?= filter($authorName) ?></a>
                                            <span><?= $lang["newspubli2"] ?> <?= date('d F, Y', $article['date']) ?> &bull; <?= $readingTime ?> min de lectura</span>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <!-- More News Section -->
                            <div class="related-news">
                                <div class="related-news-title">
                                    <img src="/assets/images/collider/feeds.png" style="width: 20px;">
                                    <?= $lang["Nlastnews"] ?>
                                </div>
                                <div class="related-grid">
                                    <?php
                                    $stmt = $dbh->prepare("SELECT id, title, image, shortstory FROM cms_news WHERE id != :id ORDER BY date DESC LIMIT 3");
                                    $stmt->bindParam(':id', $article['id']);
                                    $stmt->execute();
                                    while ($r = $stmt->fetch()):
                                        $rImg = (!empty($r['image'])) ? $r['image'] : "/assets/images/news/default_news.png";
                                    ?>
                                        <a href="/articles/<?= $r['id'] ?>" class="related-card">
                                            <div class="related-thumb" style="background-image: url('<?= filter($rImg) ?>')"></div>
                                            <div class="related-info">
                                                <div class="related-card-title"><?= filter($r['title']) ?></div>
                                            </div>
                                        </a>
                                    <?php endwhile; ?>
                                </div>
                            </div>

                        <?php else: ?>
                            <div class="sidebar-widget" style="text-align: center; padding: 60px;">
                                <img src="/assets/images/not-found/fank_walksaway.png" style="margin-bottom: 20px;">
                                <h2 style="font-size: 24px; font-weight: 800;"><?= $lang["Nnotfoundheader"] ?></h2>
                                <p style="opacity: 0.7; margin-bottom: 30px;"><?= $lang["Nnotfoundtxt"] ?></p>
                                <a href="/me" class="enter-hotel-btn" style="display: inline-block; padding: 12px 30px;"><?= $lang["Rbinicio"] ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="page-content-sidebar" style="width: 380px;">
                    <!-- Archive Widget -->
                    <div class="sidebar-widget">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                            <img src="/assets/images/collider/feeds.png" style="width: 24px; height: 24px;">
                            <h3 style="font-size: 16px; font-weight: 800; margin: 0;"><?= $lang["newslist"] ?></h3>
                        </div>

                        <div class="archive-widget">
                            <?php
                            $sections = [
                                ['name' => $lang["Ntoday"], 'min' => time() - 86400, 'max' => time()],
                                ['name' => $lang["Nyesterday"], 'min' => time() - 172800, 'max' => time() - 86400],
                                ['name' => $lang["Nthismonth"], 'min' => time() - 2592000, 'max' => time() - 172800],
                            ];

                            foreach ($sections as $section) {
                                $stmt = $dbh->prepare("SELECT id, title FROM cms_news WHERE date >= :min AND date <= :max ORDER BY date DESC LIMIT 5");
                                $stmt->bindParam(':min', $section['min']);
                                $stmt->bindParam(':max', $section['max']);
                                $stmt->execute();

                                if ($stmt->rowCount() > 0) {
                                    echo '<div class="archive-section-label">' . filter($section['name']) . '</div>';
                                    while ($a = $stmt->fetch()) {
                                        $activeClass = ($articleFound && $article['id'] == $a['id']) ? 'active' : '';
                                        echo '<a href="/articles/' . filter($a['id']) . '" class="archive-item ' . $activeClass . '">
                                                <div class="archive-icon"><img src="/assets/images/collider/feeds.png" style="width: 16px;"></div>
                                                <div class="archive-item-info">
                                                    <span class="archive-item-title">' . filter($a['title']) . '</span>
                                                </div>
                                              </a>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Standard Sidebar Widgets -->
                    <?php
                    if (file_exists('includes/sidebar.php')) {
                        // To avoid the double wrapper from sidebar.php, we use output buffering
                        ob_start();
                        include("includes/sidebar.php");
                        $sidebarHtml = ob_get_clean();
                        // Remove the outer <div class="page-content-sidebar"> and its closing </div>
                        $sidebarHtml = preg_replace('/<div class="page-content-sidebar">/i', '', $sidebarHtml, 1);
                        $sidebarHtml = preg_replace('/<\/div>\s*$/i', '', $sidebarHtml);
                        echo $sidebarHtml;
                    }
                    ?>
                </div>

            </div>
        </div>

        <?php if (file_exists('includes/footer.php')) include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>