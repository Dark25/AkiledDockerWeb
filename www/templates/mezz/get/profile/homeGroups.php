<?php
$userId = userHome('id');
$stmt = $dbh->prepare("SELECT * FROM groups WHERE owner_id = :userid LIMIT 10");
$stmt->bindParam(':userid', $userId);
$stmt->execute();
if ($stmt->RowCount() > 0) {
    while ($groups = $stmt->fetch()) {
?>
        <img src="<?= $config['badgeURL'] ?><?= filter($groups["badge"]) ?>.png" class='page-content-collider-content-profile-card-wrapper-aligner-content-badge' data-toggle='tooltip' data-original-title='<?= filter($groups["name"]) ?>'>
<?php
    }
} else {
    echo '<div class="empty-state"><i>🏘️</i><p>' . filter(userHome('username')) . ' no tiene grupos en este momento.</p></div>';
}
?>
