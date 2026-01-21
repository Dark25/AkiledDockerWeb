<?php
$userId = userHome('id');
$stmt = $dbh->prepare("SELECT * FROM user_photos WHERE user_id = :userid LIMIT 4");
$stmt->bindParam(':userid', $userId);
$stmt->execute();
if ($stmt->RowCount() > 0) {
    while ($photos = $stmt->fetch()) {
?>
        <div class='page-content-collider-content-profile-photo'>
            <span class='page-content-collider-content-profile-photo-promo pixelated' style='background-image: url(<?php echo $config['roomphotos'] ?><?= filter($photos["photo"]) ?>.png)'></span>
        </div>
<?php
    }
} else {
    echo '<p style="grid-column: 1 / -1; color: var(--profile-text-muted);">' . filter(userHome('username')) . ' no tiene fotos en este momento.</p>';
}
?>
