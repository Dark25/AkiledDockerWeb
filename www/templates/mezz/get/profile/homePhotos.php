<div class="page-content-collider-content-profile-photos">

    <?php
    $userId = userHome('id');
    $stmt = $dbh->prepare("SELECT * FROM user_photos WHERE user_id = :userid LIMIT 4");
    $stmt->bindParam(':userid', $userId);
    $stmt->execute();
    if (!$stmt->RowCount() == 0) {
        while ($photos = $stmt->fetch()) {
    ?>
            <div class='page-content-collider-content-profile-photo'>
                <?php
                $rawPhoto = filter($photos["photo"]);
                if (preg_match('/\.(png|jpg|jpeg|gif)$/i', $rawPhoto)) {
                    $photoUrl = $config['roomphotos'] . $rawPhoto;
                } else {
                    $photoUrl = $config['roomphotos'] . $rawPhoto . '.png';
                }
                ?>

                <img class='page-content-collider-content-profile-photo-promo' src='<?php echo $photoUrl ?>' alt='photo' style='width:100%;height:100%;object-fit:cover;border-radius:8px;display:block;'>

            </div>
    <?php
        }
    } else {
        echo userHome('username') . ' no tiene fotos en este momento.';
    }
    ?>

</div>