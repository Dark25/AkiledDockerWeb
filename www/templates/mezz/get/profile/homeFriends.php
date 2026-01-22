<div class="page-content-collider-content-profile-card-wrapper-aligner-content">
    <h2 class="page-content-collider-content-profile-card-wrapper-aligner-content-title">Amigos</h2>

    <?php
    $userId = userHome('id');
    $sql = $dbh->prepare("SELECT user_one_id, user_two_id FROM messenger_friendships WHERE user_one_id=:userid OR user_two_id=:userid");
    $sql->bindParam(':userid', $userId);
    $sql->execute();
    if (!$sql->RowCount() == 0) {
        $friend_ids = [];
        while ($news = $sql->fetch()) {
            $friend_id = ($userId == $news['user_two_id'] ? $news['user_one_id'] : $news['user_two_id']);
            $friend_ids[] = $friend_id;
        }

        $unique_friend_ids = array_unique($friend_ids);

        foreach ($unique_friend_ids as $id) {
            $getUser = $dbh->prepare("SELECT * FROM users WHERE id = :id");
            $getUser->bindParam(':id', $id);
            $getUser->execute();
            $getUserData = $getUser->fetch();

            if ($getUserData) {
    ?>
                <div class="page-content-collider-content-profile-card-wrapper-aligner-content-friend">
                    <img src="<?= $config['lookUrl'] ?><?= filter($getUserData['look']) ?>&action=std&direction=3&head_direction=3&img_format=undefined&gesture=sml&headonly=0&size=b" alt="<?= filter($getUserData['username']) ?>" class="page-content-collider-content-profile-card-wrapper-aligner-content-friend-figure">
                    <p class="page-content-collider-content-profile-card-wrapper-aligner-content-friend-username"><?= filter($getUserData['username']) ?></p>
                </div>
    <?php
            }
        }
    } else {
        echo userHome('username') . ' no tiene amigos en este momento.';
    }
    ?>
</div>
