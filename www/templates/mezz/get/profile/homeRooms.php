<?php
$userId = userHome('username');
$stmt = $dbh->prepare("SELECT * FROM rooms WHERE owner = :username LIMIT 4");
$stmt->bindParam(':username', $userId);
$stmt->execute();
if ($stmt->RowCount() > 0) {
    while ($room = $stmt->fetch()) {
?>
        <div class='page-content-collider-content-profile-card-wrapper-aligner-content-room'>
            <img src='/assets/images/profile/default-room.png' alt='<?= filter($room["caption"]) ?>' class='page-content-collider-content-profile-card-wrapper-aligner-content-room-image'>
            <p class='page-content-collider-content-profile-card-wrapper-aligner-content-room-name'><?= mb_strimwidth(filter($room["caption"]), 0, 30, '...') ?></p>
        </div>
<?php
    }
} else {
    echo '<p style="grid-column: 1 / -1; color: var(--profile-text-muted);">' . filter(userHome('username')) . ' no tiene habitaciones en este momento.</p>';
}
?>
