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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $articleFound ? filter($article['title']) : $lang["Nnews"] ?></title>

    <style>
        .article-container {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .article-header {
            position: relative;
            height: 250px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            padding: 40px;
        }

        .article-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
        }

        .article-header-content {
            position: relative;
            z-index: 1;
            width: 100%;
        }

        .article-category {
            background: #eeb425;
            color: #fff;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 12px;
            display: inline-block;
        }

        .article-title {
            color: #fff;
            font-size: 32px;
            font-weight: 800;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .article-body {
            padding: 40px;
        }

        .article-shortstory {
            font-size: 18px;
            color: #1e293b;
            font-weight: 600;
            line-height: 1.6;
            margin-bottom: 25px;
            padding-left: 20px;
            border-left: 4px solid #eeb425;
        }

        .article-longstory {
            font-size: 16px;
            color: #475569;
            line-height: 1.8;
        }

        .article-footer {
            padding: 20px 40px;
            background: #f8fafc;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .article-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .article-author-avatar {
            width: 50px;
            height: 50px;
            background: #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }

        .article-author-avatar img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -40%);
            width: 90px;
            image-rendering: pixelated;
        }

        .article-author-info {
            display: flex;
            flex-direction: column;
        }

        .article-author-name {
            font-weight: 700;
            color: #1e293b;
            font-size: 15px;
        }

        .article-date {
            font-size: 13px;
            color: #64748b;
        }

        .news-archive-widget h2 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin: 20px 0 10px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #f1f5f9;
        }

        .news-archive-widget h2:first-child {
            margin-top: 0;
        }

        .news-archive-item {
            display: block;
            padding: 10px 12px;
            color: #64748b;
            font-size: 14px;
            border-radius: 8px;
            transition: all 0.2s;
            margin-bottom: 4px;
            text-decoration: none;
        }

        .news-archive-item:hover {
            background: #f1f5f9;
            color: #1e293b;
            padding-left: 18px;
        }

        .news-archive-item.active {
            background: #fef3c7;
            color: #b45309;
            font-weight: 600;
        }

        .error-container {
            text-align: center;
            padding: 60px 20px;
        }

        .error-image {
            margin-bottom: 20px;
        }

        .error-title {
            font-size: 24px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .error-text {
            color: #64748b;
        }

        /* Override some existing styles for better look */
        .page-content-max-width.has-sidebar {
            margin-top: 30px;
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
                            <div class="article-header" style="background-image: url('<?= filter($article['image']) ?>')">
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
                                        <img src="<?= $config['AvatarURL'] ?><?= filter($article['look']) ?>&direction=2&head_direction=3&gesture=sml&size=m">
                                    </div>
                                    <div class="article-author-info">
                                        <a href="/profile/<?= filter($article['author_name']) ?>" class="article-author-name"><?= filter($article['author_name']) ?></a>
                                        <span class="article-date"><?= date('d F, Y', $article['date']) ?></span>
                                    </div>
                                </div>
                                <div class="article-share">
                                    <!-- Optional share buttons could go here -->
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
                                <a href="/me" class="enter-hotel-btn" style="display: inline-block; margin-top: 20px; padding: 10px 30px;">Volver al inicio</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="page-content-sidebar">
                    <div class="sidebar-widget news-archive-widget">
                        <div class="widget-title" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                            <img src="/assets/images/collider/feeds.png" style="width: 24px; height: 24px;">
                            <h3 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0;"><?= $lang["Nnews"] ?></h3>
                        </div>

                        <div class="news-archive-content">
                            <?php
                            // Improved news archive list
                            for ($i = 0; $i < 6; $i++) {
                                $sectionName = "";
                                $sectionCutoffMax = 0;
                                $sectionCutoffMin = 0;
                                switch ($i) {
                                    case 0: $sectionName = $lang["Ntoday"]; $sectionCutoffMax = time(); $sectionCutoffMin = time() - 86400; break;
                                    case 1: $sectionName = $lang["Nyesterday"]; $sectionCutoffMax = time() - 86400; $sectionCutoffMin = time() - 172800; break;
                                    case 2: $sectionName = $lang["Nthisweek"]; $sectionCutoffMax = time() - 172800; $sectionCutoffMin = time() - 604800; break;
                                    case 3: $sectionName = $lang["Nlastweek"]; $sectionCutoffMax = time() - 604800; $sectionCutoffMin = time() - 1209600; break;
                                    case 4: $sectionName = $lang["Nthismonth"]; $sectionCutoffMax = time() - 1209600; $sectionCutoffMin = time() - 2592000; break;
                                    case 5: $sectionName = $lang["Nlastmonth"]; $sectionCutoffMax = time() - 2592000; $sectionCutoffMin = time() - 5184000; break;
                                }

                                $getArticles = $dbh->prepare("SELECT id, title FROM cms_news WHERE date >= :sectionCutoffMin AND date <= :sectionCutoffMax ORDER BY date DESC");
                                $getArticles->bindParam(':sectionCutoffMin', $sectionCutoffMin);
                                $getArticles->bindParam(':sectionCutoffMax', $sectionCutoffMax);
                                $getArticles->execute();

                                if ($getArticles->rowCount() > 0) {
                                    echo "<h2>" . filter($sectionName) . "</h2>";
                                    while ($a = $getArticles->fetch()) {
                                        $activeClass = (isset($_GET['id']) && $_GET['id'] == $a['id']) ? 'active' : '';
                                        echo '<a href="/articles/' . filter($a['id']) . '" class="news-archive-item ' . $activeClass . '">' . filter($a['title']) . '</a>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <?php include_once("includes/sidebar.php"); ?>
                </div>

            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>