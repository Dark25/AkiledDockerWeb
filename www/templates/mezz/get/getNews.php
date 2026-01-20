<div class="page-content-collider-item">
    <div class="page-content-collider-head">
        <span class="page-content-collider-head-icon news"></span>
        <div class="page-content-collider-head-column">
            <h2 class="page-content-collider-head-title"><?=$lang["Nlastnews"]?></h2>
            <p class="page-content-collider-head-description"><?=$lang["Ndescnews"]?></p>
        </div>
    </div>
    <div class="page-content-collider-content">
    <?php
					$sql = $dbh->prepare("SELECT u.look AS current_look, u.username, n.id, n.title, n.image, n.author FROM users u JOIN cms_news n ON u.username = n.author ORDER BY n.id DESC LIMIT 4");
					$sql->execute();
					while ($news = $sql->fetch())
					{
                    ?>
                    
                        <a href="/articles/<?php echo filter($news["id"]); ?>" class="page-content-collider-content-article">
                            <span class="page-content-collider-content-article-promo pixelated" style="background-image: url('<?php echo filter($news["image"]); ?>')"></span>
                            <h2 class="page-content-collider-content-article-title"><?php echo filter($news["title"]); ?></h2>
                            <div class="page-content-collider-content-article-bottom-side">
                                <div class="page-content-collider-content-article-bottom-side-avatar">
                                    <span class="page-content-collider-content-article-bottom-side-avatar-figure pixelated" style="background-image: url('<?php echo $config['AvatarURL']; ?><?php echo filter($news["current_look"]); ?>&action=std&direction=2&head_direction=2&gesture=sml&headonly=1&size=b')"></span>
                                    <span class="page-content-collider-content-article-bottom-side-avatar-username"><?php echo filter($news["username"]); ?></span>
                                </div>
                            </div>
                        </a>
					<?php } ?>
    </div>
</div>