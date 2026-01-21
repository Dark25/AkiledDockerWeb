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
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app-dark.css" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" type="text/css" href="/assets/styles/news.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $articleFound ? filter($article['title']) : $lang["Nnews"] ?></title>
</head>

<body class="container news-page-theme">
    <script src="/assets/scripts/page-load.js"></script>

    <!-- Reading Progress Bar -->
    <div class="reading-progress-container">
        <div class="reading-progress-bar" id="progressBar"></div>
    </div>

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

                        <!-- Premium Breadcrumbs -->
                        <div class="breadcrumbs-premium">
                            <a href="/me" class="breadcrumb-item"><?= $lang["Minicio"] ?></a>
                            <div class="breadcrumb-separator"></div>
                            <a href="/articles" class="breadcrumb-item"><?= $lang["Nnews"] ?></a>
                            <?php if ($articleFound): ?>
                                <div class="breadcrumb-separator"></div>
                                <span class="breadcrumb-item active"><?= filter($article['title']) ?></span>
                            <?php endif; ?>
                        </div>

                        <?php if ($articleFound): ?>
                            <article class="premium-article">
                                <!-- Immersive Hero Section -->
                                <div class="article-hero-premium">
                                    <div class="hero-bg-blur" style="background-image: url('<?= filter($articleImage) ?>')"></div>
                                    <div class="hero-main-image" style="background-image: url('<?= filter($articleImage) ?>')"></div>
                                    <div class="hero-overlay-premium">
                                        <div class="hero-content-premium">
                                            <div class="article-badge-premium"><?= $lang["Nnews"] ?></div>
                                            <h1 class="article-title-premium"><?= filter($article['title']) ?></h1>

                                            <div class="article-meta-premium">
                                                <div class="meta-item-premium">
                                                    <img src="/assets/images/collider/users.png" class="meta-icon">
                                                    <span><?= filter($authorName) ?></span>
                                                </div>
                                                <div class="meta-divider"></div>
                                                <div class="meta-item-premium">
                                                    <img src="/assets/images/collider/feeds.png" class="meta-icon">
                                                    <span><?= date('d M, Y', $article['date']) ?></span>
                                                </div>
                                                <div class="meta-divider"></div>
                                                <div class="meta-item-premium">
                                                    <img src="/assets/images/user-space/planeta.png" class="meta-icon" style="filter: hue-rotate(180deg);">
                                                    <span><?= $readingTime ?> min <?= $lang["leermas"] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content Body -->
                                <div class="article-body-premium">
                                    <div class="article-lead-premium">
                                        <?= html_entity_decode($article['shortstory']) ?>
                                    </div>
                                    <div class="article-text-premium">
                                        <?= html_entity_decode($article['longstory']) ?>
                                    </div>
                                </div>

                                <!-- Redesigned Author Card -->
                                <div class="author-card-premium">
                                    <div class="author-card-header">
                                        <div class="author-avatar-wrapper">
                                            <div class="author-avatar-bg">
                                                <img src="<?= $config['AvatarURL'] ?><?= filter($authorLook) ?>&direction=2&head_direction=3&gesture=sml&size=l" class="author-avatar-img">
                                            </div>
                                        </div>
                                        <div class="author-info-premium">
                                            <h3 class="author-name-premium"><?= filter($authorName) ?></h3>
                                            <p class="author-role-premium"><?= $lang["Staffinfo"] ?></p>
                                        </div>
                                        <a href="/profile/<?= filter($authorName) ?>" class="author-visit-btn">
                                            <?= $lang["Mprofile"] ?>
                                        </a>
                                    </div>
                                </div>
                            </article>

                            <!-- Premium Related News Section -->
                            <div class="related-news-premium">
                                <div class="related-header-premium">
                                    <div class="related-icon-premium">
                                        <img src="/assets/images/collider/feeds.png">
                                    </div>
                                    <h3><?= $lang["Nlastnews"] ?></h3>
                                </div>
                                <div class="related-grid-premium">
                                    <?php
                                    $stmt = $dbh->prepare("SELECT id, title, image, date FROM cms_news WHERE id != :id ORDER BY date DESC LIMIT 3");
                                    $stmt->bindParam(':id', $article['id']);
                                    $stmt->execute();
                                    while ($r = $stmt->fetch()):
                                        $rImg = (!empty($r['image'])) ? $r['image'] : "/assets/images/news/default_news.png";
                                    ?>
                                        <a href="/articles/<?= $r['id'] ?>" class="related-card-premium">
                                            <div class="related-card-thumb" style="background-image: url('<?= filter($rImg) ?>')">
                                                <div class="related-card-overlay">
                                                    <div class="related-card-badge"><?= date('d M', $r['date']) ?></div>
                                                </div>
                                            </div>
                                            <div class="related-card-info">
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
                    <div class="premium-sidebar">

                        <!-- Premium Archive Widget -->
                        <div class="sidebar-widget-premium">
                            <div class="widget-header-premium">
                                <div class="widget-icon-box">
                                    <img src="/assets/images/collider/feeds.png">
                                </div>
                                <h4><?= $lang["newslist"] ?></h4>
                            </div>

                            <div class="premium-archive-list">
                                <?php
                                $sections = [
                                    ['name' => $lang["Ntoday"], 'min' => time() - 86400, 'max' => time()],
                                    ['name' => $lang["Nyesterday"], 'min' => time() - 172800, 'max' => time() - 86400],
                                    ['name' => $lang["Nthismonth"], 'min' => time() - 2592000, 'max' => time() - 172800],
                                ];

                                foreach ($sections as $section) {
                                    $stmt = $dbh->prepare("SELECT id, title, date FROM cms_news WHERE date >= :min AND date <= :max ORDER BY date DESC LIMIT 5");
                                    $stmt->bindParam(':min', $section['min']);
                                    $stmt->bindParam(':max', $section['max']);
                                    $stmt->execute();

                                    if ($stmt->rowCount() > 0) {
                                        echo '<div class="archive-label-premium">' . filter($section['name']) . '</div>';
                                        while ($a = $stmt->fetch()) {
                                            $activeClass = ($articleFound && $article['id'] == $a['id']) ? 'active' : '';
                                            echo '<a href="/articles/' . filter($a['id']) . '" class="premium-archive-item ' . $activeClass . '">
                                                    <div class="archive-dot"></div>
                                                    <div class="archive-item-content">
                                                        <span class="archive-item-name">' . filter($a['title']) . '</span>
                                                        <span class="archive-item-date">' . date('d M', $a['date']) . '</span>
                                                    </div>
                                                  </a>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Staff Online Widget -->
                    <div class="sidebar-widget">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                            <img src="/assets/images/collider/users.png" style="width: 24px; height: 24px;">
                            <h3 style="font-size: 16px; font-weight: 800; margin: 0;"><?= $lang["Mstaff"] ?> Online</h3>
                        </div>
                        <div class="staff-online-widget">
                            <?php
                            $stmt = $dbh->prepare("SELECT username, look, online FROM users WHERE rank >= 10 AND online = 1 LIMIT 5");
                            $stmt->execute();
                            if ($stmt->rowCount() > 0) {
                                while ($staff = $stmt->fetch()):
                            ?>
                                <a href="/profile/<?= filter($staff['username']) ?>" class="staff-online-item">
                                    <div class="staff-online-avatar">
                                        <img src="<?= $config['AvatarURL'] ?><?= filter($staff['look']) ?>&direction=2&head_direction=3&gesture=sml&size=s">
                                    </div>
                                    <div class="staff-online-info">
                                        <div class="staff-online-name"><?= filter($staff['username']) ?></div>
                                        <div class="staff-online-rank">En línea</div>
                                    </div>
                                </a>
                            <?php
                                endwhile;
                            } else {
                                echo '<p style="font-size: 13px; color: var(--text-muted); text-align: center;">No hay staff en línea.</p>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Latest Photos Widget -->
                    <div class="sidebar-widget">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                            <img src="/assets/images/collider/camera.png" style="width: 24px; height: 24px;">
                            <h3 style="font-size: 16px; font-weight: 800; margin: 0;"><?= $lang["Plastphotos"] ?></h3>
                        </div>
                        <div class="photo-grid-widget">
                            <?php
                            $stmt = $dbh->prepare("SELECT photo FROM user_photos ORDER BY time DESC LIMIT 6");
                            $stmt->execute();
                            while ($photo = $stmt->fetch()):
                            ?>
                                <div class="photo-item-sm" style="background-image: url('<?= $config['roomphotos'] ?><?= filter($photo['photo']) ?>.png')"></div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                    <!-- Standard Sidebar Widgets -->
                    <?php
                    if (file_exists('includes/sidebar.php')) {
                        include("includes/sidebar.php");
                    }
                    ?>
                </div>

            </div>
        </div>

        <?php if (file_exists('includes/footer.php')) include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
    <script>
        // Reading Progress Logic
        window.onscroll = function() { updateProgressBar() };

        function updateProgressBar() {
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var scrolled = (winScroll / height) * 100;
            document.getElementById("progressBar").style.width = scrolled + "%";
        }
    </script>
</body>

</html>