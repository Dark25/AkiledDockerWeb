<div class="page-content-sidebar">
    <!-- Widget: Usuario -->
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
        <div class="user-card-stats">
            <?php
            $roomsCount = $dbh->prepare("SELECT COUNT(*) FROM rooms WHERE owner = :username");
            $roomsCount->bindParam(':username', User::userData('username'));
            $roomsCount->execute();
            $rooms = $roomsCount->fetchColumn();

            $friendsCount = $dbh->prepare("SELECT COUNT(*) FROM messenger_friendships WHERE user_one_id = :id OR user_two_id = :id");
            $friendsCount->bindParam(':id', $_SESSION['id']);
            $friendsCount->execute();
            $friends = $friendsCount->fetchColumn();

            $likes = User::userData('user_likes');
            ?>
            <div class="user-stat" title="Salas creadas">
                <img src="/assets/images/collider/rooms.png">
                <span><?= number_format($rooms) ?></span>
            </div>
            <div class="user-stat" title="Amigos">
                <img src="/assets/images/collider/users.png">
                <span><?= number_format($friends) ?></span>
            </div>
            <div class="user-stat" title="Respetos">
                <img src="/assets/images/profile/heart.png">
                <span><?= number_format($likes) ?></span>
            </div>
        </div>
        <a href="/client-nitro" class="enter-hotel-btn">Entrar al Hotel</a>
    </div>

    <div class="sidebar-widget discord-widget">
        <div class="discord-header">
            <img src="/assets/images/profile/discord.png" class="discord-logo">
            <span>Comunidad Discord</span>
        </div>
        <p>¡Únete a nuestra comunidad para estar al tanto de todo!</p>
        <a href="https://discord.gg/akiled" target="_blank" class="discord-btn">Unirse ahora</a>
    </div>

    <!-- Widget: Highscores Cortos (Top 3 Creditos) -->
    <div class="sidebar-widget mini-ranking">
        <div class="widget-title">
            <img src="/assets/images/highscores/trophy-gold.png">
            <h3>Top Millonarios</h3>
        </div>
        <div class="mini-ranking-list">
            <?php
            $sql = $dbh->prepare("SELECT username, look, credits FROM users ORDER BY credits DESC LIMIT 3");
            $sql->execute();
            $rankCount = 1;
            while ($top = $sql->fetch()) {
            ?>
                <div class="mini-ranking-item">
                    <div class="rank-number rank-<?= $rankCount ?>"><?= $rankCount ?></div>
                    <div class="rank-avatar" style="background-image: url('<?php echo $config['AvatarURL']; ?><?= filter($top['look']) ?>&direction=2&head_direction=2&gesture=sml&headonly=0&size=b')"></div>
                    <div class="rank-info">
                        <span class="rank-username"><?= filter($top['username']) ?></span>
                        <span class="rank-value"><?= number_format($top['credits']) ?> cr.</span>
                    </div>
                </div>
            <?php $rankCount++; } ?>
        </div>
        <a href="/highscores" class="view-all-link">Ver todos los rankings</a>
    </div>
</div>
