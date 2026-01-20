<div class="page-content-collider-item">
    <div class="page-content-collider-head">
        <span class="page-content-collider-head-icon camera"></span>
        <div class="page-content-collider-head-column">
            <h2 class="page-content-collider-head-title"><?=$lang["Plastphotos"]?></h2>
            <p class="page-content-collider-head-description"><?=$lang["Pdescphotos"]?></p>
        </div>
    </div>
    <div class="page-content-collider-content">
      <?php
          $sql = $dbh->prepare("SELECT u.username, u.look AS current_look, p.photo FROM 
          user_photos p
          JOIN users u
          ON p.user_id = u.id 
          ORDER BY time DESC LIMIT 4");
          $sql->execute();
          while ($news = $sql->fetch())
          {
      ?>
        <div class="page-content-collider-content-photos">
          <span class="page-content-collider-content-photos-promo pixelated" style="background-image: url(<?php echo $config['roomphotos'] ?><?php echo filter($news["photo"]) ?>.png)"></span>

          <div class="page-content-collider-content-photos-bottom-side">
            <a href="/profile/<?php echo filter($news["username"]) ?>" class="page-content-collider-content-photos-bottom-side-avatar">
                        
              <span class="page-content-collider-content-photos-bottom-side-avatar-figure pixelated" style="background-image: url('<?php echo $config['AvatarURL']; ?><?php echo filter($news["current_look"]) ?>&action=std&direction=2&head_direction=2&gesture=sml&headonly=1&size=b')"></span>

                <span class="page-content-collider-content-photos-bottom-side-avatar-username"><?php echo filter($news["username"]) ?></span></a>
            
          </div>
        </div>
        <?php } ?>
    </div>
</div>