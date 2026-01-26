<?php
$news_active = 'active';

if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
    $latestNews = $dbh->query("SELECT id FROM cms_news ORDER BY id DESC LIMIT 1")->fetch();
    $newsid = $latestNews ? $latestNews['id'] : 0;
} else {
    $newsid = $_GET['id'];
}

$stmt = $dbh->prepare("
    SELECT n.*, u.username, u.look
    FROM cms_news n
    LEFT JOIN users u ON n.author = u.username
    WHERE n.id = :id
    LIMIT 1
");
$stmt->bindParam(':id', $newsid);
$stmt->execute();
$newsData = $stmt->fetch();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <title><?= $config['hotelName'] ?>: <?= $newsData ? filter($newsData['title']) : $lang["Nnews"] ?></title>
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

        <div class="page-content-collider">
            <div class="page-content-max-width has-sidebar">
                <div class="page-content-main-column">

                    <?php if ($newsData): ?>
                        <article class="news-article-container">
                            <div class="news-article-banner" style="background-image: url('<?= filter($newsData['image']) ?>')">
                                <div class="news-article-header-overlay">
                                        <span class="news-article-category"><?= $lang["Nnews"] ?></span>
                                    <h1 class="news-article-title"><?= filter($newsData['title']) ?></h1>
                                    <div class="news-article-meta">
                                        <div class="meta-item">
                                            <div class="news-article-author-img" style="background-image: url('<?php echo $config['AvatarURL'] ?><?php echo filter($newsData['look']) ?>&direction=2&head_direction=2&gesture=sml&headonly=1&size=s')"></div>
                                            <span>Por <b><?= filter($newsData['username']) ?></b></span>
                                        </div>
                                        <div class="meta-item">
                                            <span style="font-size: 16px;">📅</span>
                                            <?= date('d M, Y', $newsData['date']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="news-article-content">
                                <div class="news-article-shortstory">
                                    <?= html_entity_decode($newsData['shortstory']) ?>
                                </div>
                                <div class="news-article-longstory">
                                    <?= html_entity_decode($newsData['longstory']) ?>
                                </div>
                            </div>

                            <div class="news-article-footer">
                                <div class="author-badge">
                                    <div class="news-article-author-img" style="background-image: url('<?php echo $config['AvatarURL'] ?><?php echo filter($newsData['look']) ?>&direction=2&head_direction=2&gesture=sml&headonly=0&size=b'); width: 45px; height: 45px; background-position: center -15px; border: 2px solid var(--news-primary);"></div>
                                    <div class="author-badge-info">
                                        <h4><?= filter($newsData['username']) ?></h4>
                                        <span>Redactor de <?= $config['hotelName'] ?></span>
                                    </div>
                                </div>
                                <div class="share-actions">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $config['hotelUrl']; ?>/articles/<?php echo $newsData['id']; ?>" target="_blank" class="share-circle" title="<?= $lang["Mefolow2"] ?>" style="font-weight: bold; color: #1877f2;">f</a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo $config['hotelUrl']; ?>/articles/<?php echo $newsData['id']; ?>&text=<?php echo filter($newsData['title']); ?>" target="_blank" class="share-circle" title="<?= $lang["Mefolow1"] ?>" style="font-weight: bold; color: #1da1f2;">t</a>
                                    <div class="share-circle" title="Copiar Enlace" style="font-size: 18px; cursor: pointer;" onclick="navigator.clipboard.writeText(window.location.href); alert('Enlace copiado');">🔗</div>
                                </div>
                            </div>
                        </article>
                    <?php else: ?>
                        <div class="news-article-container" style="padding: 60px; text-align: center;">
                            <div style="font-size: 60px; margin-bottom: 20px;">⚠️</div>
                            <h2 style="font-size: 24px; color: #1e293b; margin-bottom: 10px;"><?= $lang["Nnotfoundheader"] ?></h2>
                            <p style="color: #64748b; margin-bottom: 30px;"><?= $lang["Nnotfoundtxt"] ?></p>
                            <a href="/articles/<?php echo $newsid; ?>" style="display: inline-block; padding: 12px 30px; background: var(--news-primary); color: #fff; border-radius: 10px; font-weight: 700; transition: background 0.2s;">Reintentar</a>
                        </div>
                    <?php endif; ?>

                </div>

                <?php include_once("includes/news-sidebar.php"); ?>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js"></script>
</body>

</html>