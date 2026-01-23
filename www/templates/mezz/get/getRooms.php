<?php
if (!isset($dbh)) {
    include_once('../../../system/brain-config.php');
}

$getRooms = $dbh->prepare("SELECT r.id, r.caption, r.description, r.users_now, u.username, u.look
                           FROM rooms r
                           JOIN users u ON r.owner = u.username
                           ORDER BY r.users_now DESC
                           LIMIT 20");
$getRooms->execute();

if ($getRooms->rowCount() > 0) {
    while ($room = $getRooms->fetch()) {
        // Prefer caption, then description, then a default label
        $rawCaption = trim((string)$room['caption']);
        $rawDescription = trim((string)$room['description']);
        $roomFullTitle = $rawCaption !== '' ? $rawCaption : ($rawDescription !== '' ? $rawDescription : 'Sala sin nombre');
        // Shorten for display but keep full title on hover
        $roomName = filter(mb_strimwidth($roomFullTitle, 0, 40, '...'));
        $roomTitleAttr = filter($roomFullTitle);
        $ownerName = filter($room['username']);
        $usersNow = (int)$room['users_now'];
        $look = filter($room['look']);
        ?>
        <article class="room-card">
            <div class="room-card-preview" style="background-image: url('<?= $config['roomthumball'] . $room['id'] ?>.png');">
                <div class="room-users-count">
                    <i class="fas fa-users"></i>
                    <span><?= $usersNow ?></span>
                </div>
            </div>
            <div class="room-card-info">
                <h3 class="room-card-name" title="<?= $roomTitleAttr ?>"><?= $roomName ?></h3>
                <div class="room-card-owner">
                    <img src="<?= htmlspecialchars($config['AvatarURL'] . rawurlencode($look) . '&direction=2&head_direction=2&gesture=sml&size=m', ENT_QUOTES, 'UTF-8') ?>" alt="<?= $ownerName ?>" width="32" height="32" loading="lazy">
                    <span>Por <strong><?= $ownerName ?></strong></span>
                </div>
                <div class="room-card-actions">
                    <a href="/client?roomid=<?= $room['id'] ?>" class="room-enter-btn">
                        <?= $lang["Ienter"] ?>
                    </a>
                </div>
            </div>
        </article>
        <?php
    }
} else {
    ?>
    <div class="rooms-empty">
        <i class="fas fa-door-closed"></i>
        <p>Actualmente no hay habitaciones.</p>
    </div>
    <?php
}
?>
