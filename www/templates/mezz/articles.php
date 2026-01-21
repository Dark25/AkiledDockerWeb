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

// Default values if author not found in users table
$authorLook = (!empty($article['look'])) ? $article['look'] : "hr-115-42.hd-190-1.ch-215-62.lg-285-64.sh-290-62";
$authorName = (!empty($article['author_name'])) ? $article['author_name'] : ($article['author'] ?? "Staff");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app-dark.css" media="(prefers-color-scheme: dark)">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $articleFound ? filter($article['title']) : $lang["Nnews"] ?></title>
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
            <div class="page-content-max-width" style="flex-direction: column; align-items: flex-start;">
                <div class="page-content-collider-item">
                    <div class="page-content-collider-content news">

                        <!-- Left side: News List -->
                        <div class="page-content-collider-content-news-left-side">
                            <h2 class="page-content-collider-content-news-left-side-title"><?= $lang["Nnews"] ?></h2>
                            <div class="page-content-collider-content-news-left-side-item">
                                <?php include_once("get/getMonths.php"); ?>
                            </div>
                        </div>

                        <!-- Right side: Article Content -->
                        <div class="page-content-collider-content-news-right-side">
                            <div class="page-content-collider-content-news-right-side-content">
                                <?php if ($articleFound): ?>
                                    <h2 class="page-content-collider-content-news-right-side-content-title">
                                        <?= filter($article['title']) ?>
                                    </h2>

                                    <p><b><?= html_entity_decode($article['shortstory']) ?></b></p>
                                    <p><?= html_entity_decode($article['longstory']) ?></p>

                                    <div class="page-content-collider-content-news-right-side-content-article-author">
                                        <span class="page-content-collider-content-news-right-side-content-article-author-figure"
                                              style="background-image: url(<?= $config['AvatarURL'] ?><?= filter($authorLook) ?>&action=std&direction=2&head_direction=3&gesture=sml&headonly=0&size=b);">
                                        </span>

                                        <a href="/profile/<?= filter($authorName) ?>" class="page-content-collider-content-news-right-side-content-article-author-username">
                                            <?= filter($authorName) ?>
                                        </a>

                                        <p style="margin-left: 440px; margin-top: 30px; font-weight: bold;">
                                            <?= date('d/m/Y', $article['date']) ?>
                                        </p>
                                    </div>
                                <?php else: ?>
                                    <h2 class="page-content-collider-content-news-right-side-content-title"><?= $lang["Nnotfoundheader"] ?> »</h2>
                                    <p><?= $lang["Nnotfoundtxt"] ?></p>
                                <?php endif; ?>
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