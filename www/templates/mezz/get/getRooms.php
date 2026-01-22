<?php

$getRooms = $dbh->prepare("SELECT rooms.*, users.username, users.look FROM rooms JOIN users ON rooms.owner = users.username ORDER BY rooms.users_now DESC, rooms.id DESC LIMIT 20");
$getRooms->execute();

if ($getRooms->rowCount() > 0)
{
    while ($roomRow = $getRooms->fetch())
    {
    ?>
    <article class="room-card">
        <div class="room-image-wrapper">
            <div class="room-image" style="background-image: url('/assets/images/collider/default-room-image.png');"></div>
            <div class="room-overlay"></div>
            <?php if ($roomRow['users_now'] > 0): ?>
            <div class="room-users-count">
                <i class="fas fa-user"></i>
                <?= filter($roomRow['users_now']) ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="room-content">
            <h2 class="room-title"><?= filter($roomRow['caption']) ?></h2>
            <p class="room-description"><?= filter($roomRow['description']) ?></p>
            <div class="room-footer">
                <a href="/profile/<?= filter($roomRow['username']) ?>" class="room-owner">
                    <div class="room-owner-avatar" style="background-image: url('<?= $config['AvatarURL']; ?><?= filter($roomRow['look']) ?>&direction=2&head_direction=2&gesture=sml&headonly=1&size=b');"></div>
                    <span class="room-owner-name"><?= filter($roomRow['username']) ?></span>
                </a>
                <a href="/client?room=<?= filter($roomRow['id']) ?>" class="room-enter-btn" title="Entrar a la sala">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </article>
<?php
    }
}
else
{
    ?>
    <div class="photos-empty" style="grid-column: 1 / -1;">
        <i class="fas fa-door-closed"></i>
        <p>No hay salas disponibles en este momento.</p>
    </div>
    <?php
}
?>
