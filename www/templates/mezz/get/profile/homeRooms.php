<?php
$userId = userHome('username');
$stmt = $dbh->prepare("SELECT * FROM rooms WHERE owner = :username LIMIT 6");
$stmt->bindParam(':username', $userId);
$stmt->execute();
if ($stmt->RowCount() > 0) {
    while ($room = $stmt->fetch()) {
?>
        <div class='page-content-collider-content-profile-card-wrapper-aligner-content-room'>
            <img src='/assets/images/profile/default-room.png' alt='<?= filter($room["caption"]) ?>' class='page-content-collider-content-profile-card-wrapper-aligner-content-room-image'>
            <div class="room-info">
                <p class='page-content-collider-content-profile-card-wrapper-aligner-content-room-name'><?= mb_strimwidth(filter($room["caption"]), 0, 25, '...') ?></p>
                <p style="font-size: 11px; color: var(--bento-text-muted); margin: 0;"><?= filter($room["users_now"]) ?> usuarios hoy</p>
            </div>
        </div>
<?php
    }
} else {
    echo '<div class="empty-state" style="grid-column: 1 / -1;"><i>🏠</i><p>' . filter(userHome('username')) . ' no tiene habitaciones en este momento.</p></div>';
}
?>
