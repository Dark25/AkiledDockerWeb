<?php
$userId = userHome('id');
$stmt = $dbh->prepare("SELECT * FROM user_badges WHERE user_id = :userid LIMIT 21");
$stmt->bindParam(':userid', $userId);
$stmt->execute();
if ($stmt->RowCount() > 0) {
    while ($badge = $stmt->fetch()) {
?>
        <img src="<?= $config['badgeURL'] ?><?= filter($badge["badge_id"]) ?>.gif" class='page-content-collider-content-profile-card-wrapper-aligner-content-badge' data-toggle='tooltip' data-original-title='<?= filter($badge["badge_id"]) ?>' onerror="this.style.display='none';">
<?php
    }
} else {
    echo '<div class="empty-state"><i>🏅</i><p>' . filter(userHome('username')) . ' no tiene placas en este momento.</p></div>';
}
?>
