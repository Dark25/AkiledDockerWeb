<div class="page-content-sidebar">
    <!-- User Widget (Standard) -->
    <?php if (isset($_SESSION['id'])): ?>
    <div class="sidebar-widget user-card">
        <div class="user-card-header">
            <div class="user-card-avatar-bg">
                <img src="<?php echo $config['AvatarURL']; ?><?= User::userData('look') ?>&direction=2&head_direction=3&gesture=sml&size=m" class="user-card-avatar">
            </div>
            <div class="user-card-info">
                <h3 class="user-card-username"><?= User::userData('username') ?></h3>
                <p class="user-card-motto"><?= User::userData('motto') ?></p>
            </div>
        </div>
        <a href="/client-nitro" class="enter-hotel-btn">Entrar al Hotel</a>
    </div>
    <?php endif; ?>

    <!-- News Archives Widget -->
    <div class="sidebar-widget news-archives">
        <div class="widget-title">
            <img src="/assets/images/collider/feeds.png" style="width: 24px; height: 24px;">
            <h3><?= $lang["Nnews"] ?></h3>
        </div>
        <div class="archives-list">
            <?php
            // Optimized: Single query to get recent news
            $recentNews = $dbh->query("SELECT id, title, date FROM cms_news ORDER BY date DESC LIMIT 30")->fetchAll();

            $sections = [
                ['name' => $lang["Ntoday"], 'min' => time() - 86400, 'max' => time()],
                ['name' => $lang["Nyesterday"], 'min' => time() - 172800, 'max' => time() - 86400],
                ['name' => $lang["Nthisweek"], 'min' => time() - 604800, 'max' => time() - 172800],
                ['name' => $lang["Nlastweek"], 'min' => time() - 1209600, 'max' => time() - 604800],
                ['name' => $lang["Nthismonth"], 'min' => time() - 2592000, 'max' => time() - 1209600],
                ['name' => $lang["Nlastmonth"], 'min' => time() - 5184000, 'max' => time() - 2592000],
            ];

            foreach ($sections as $section) {
                $articlesInSection = array_filter($recentNews, function($n) use ($section) {
                    return $n['date'] >= $section['min'] && $n['date'] < $section['max'];
                });

                if (!empty($articlesInSection)) {
                    echo '<div class="archive-section">';
                    echo '<h4 class="archive-section-title">' . filter($section['name']) . '</h4>';
                    foreach ($articlesInSection as $a) {
                        $activeClass = (isset($_GET['id']) && $_GET['id'] == $a['id']) ? 'active' : '';
                        echo '<a href="/articles/' . filter($a['id']) . '" class="archive-item ' . $activeClass . '">';
                        echo filter($a['title']);
                        echo '</a>';
                    }
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>

    <!-- Discord Widget (Standard) -->
    <div class="sidebar-widget discord-widget">
        <div class="discord-header">
            <img src="/assets/images/profile/discord.png" class="discord-logo">
            <span><?= $lang["Mefolow3"] ?></span>
        </div>
        <p>¡Únete a nuestra comunidad oficial de Discord para estar al tanto de todo!</p>
        <a href="<?= $config['discord'] ?>" target="_blank" class="discord-btn">Unirse ahora</a>
    </div>
</div>
