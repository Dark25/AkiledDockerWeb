<?php

$tablebadge = 'user_badges';
$codetable = 'badge_id';

$getBadges = $dbh->prepare("SELECT * FROM cms_badges ORDER BY id DESC");
$getBadges->execute();

while ($badges = $getBadges->fetch()) {
    $contarbadge = $dbh->prepare("SELECT * FROM " . $tablebadge . " WHERE (user_id=" . User::userData('id') . ") AND (" . $codetable . "='" . $badges["badge_id"] . "')");
    $contarbadge->execute();
    $contar = $contarbadge->fetch();

    if ($contar == 0) {
?>
        <div class="badge-card">
            <img class="badge-image" src="<?= $config['badgeURL'] ?><?= $badges["badge_id"] ?>.gif">
            <form method="POST" style="width: 100%;">
                <button class="badge-buy-btn" type="submit" name="comprarbadge<?= $badges["badge_id"] ?>">
                    <?= $lang["comprarplacap"] ?> 5
                    <img src="/assets/images/shop/esmeralda.png">
                </button>
            </form>
        </div>

        <?php
        if (isset($_POST["comprarbadge" . $badges["badge_id"]])) {
            if (User::userData('online') == "0") {
                $contarbadge = $dbh->prepare("SELECT * FROM " . $tablebadge . " WHERE (user_id=" . User::userData('id') . ") AND (" . $codetable . "='" . $badges["badge_id"] . "')");
                $contarbadge->execute();
                $contar = $contarbadge->fetch();
                if ($contar == 0) {
                    if (User::userData('activity_points') >= '5') {
                        $quitardiamonds = $dbh->prepare("UPDATE users SET activity_points=activity_points-5 WHERE id=" . User::userData('id'));
                        $quitardiamonds->execute();

                        $ponerplaca = $dbh->prepare("INSERT INTO " . $tablebadge . " (user_id, " . $codetable . ") VALUES (" . User::userData('id') . ", '" . $badges["badge_id"] . "')");
                        $ponerplaca->execute();
                        echo "<script>window.location.href='/shop';</script>";
                    } else {
                        echo "<div class='error' style='display:block;'>" . $lang["shoperror1"] . "</div>";
                    }
                } else {
                    echo "<div class='error' style='display:block;'>" . $lang["errorplacadoble"] . "</div>";
                }
            } else {
                echo "<div class='error' style='display:block;'>" . $lang["shoperror3"] . "</div>";
            }
        }
    } else {
        ?>
        <div class="badge-card">
            <img class="badge-image" src="<?= $config['badgeURL'] ?><?= $badges["badge_id"] ?>.gif">
            <div class="badge-buy-btn owned">
                <?= $lang["inventariobadge"] ?>
            </div>
        </div>
<?php
    }
}
?>