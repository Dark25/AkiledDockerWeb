<div class="page-content-collider-content-news-right-side">
  <div class="page-content-collider-content-news-right-side-content">

    <?php
    // Validación del ID
    if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
        echo '<h2 class="page-content-collider-content-news-right-side-content-title">' . $lang["Nnotfoundheader"] . ' »</h2>';
        echo '<p>' . $lang["Nnotfoundtxt"] . '</p>';
        exit;
    }

    $reportId = (int)$_GET['id'];

    // Obtener el reporte principal
    $news = $dbh->prepare("SELECT id,title,category,problem,state,staff,time,author FROM cms_reports WHERE id = :newsid");
    $news->bindParam(':newsid', $reportId, PDO::PARAM_INT);
    $news->execute();

    if ($news->rowCount() == 1) {
        $news2 = $news->fetch();

        include_once("getButtons.php");

        // Autor del reporte
        $authorStmt = $dbh->prepare("SELECT * FROM users WHERE username = :author");
        $authorStmt->bindValue(':author', $news2['author']);
        $authorStmt->execute();
        $author = $authorStmt->fetch();
    ?>
        <div class="help-card-header">
            <h2 class="help-card-main-title"><?= $lang["ReportTituloGet"] ?>: <?= filter($news2["title"]); ?></h2>
            <p class="help-card-main-subtitle"><?= $lang["Reportcatetorias1get"] ?>: <?= filter($news2['category']); ?></p>

            <span class="help-header-badge <?= ($news2['state']=='Abierto' ? 'status-open' : ($news2['state']=='Tratamiento' ? 'status-progress' : 'status-closed')); ?>">
                <?= filter($news2['state']); ?>
            </span>

            <?php if ($author) { ?>
                <div class="help-author" aria-hidden="true">
                    <span class="help-author-figure">
                        <img src="<?= $config['AvatarURL'] . filter($author['look']); ?>&direction=2&head_direction=3&gesture=sml&size=b" alt="<?= filter($author['username']); ?> avatar">
                    </span>
                    <div class="help-author-name"><?= filter($author['username']); ?></div>
                </div>
            <?php } ?>
        </div>

        <div class="help-main-body">
            <p><b><?= $lang["Reportcatetorias2get"] ?>: </b><?= filter($news2['problem']); ?></p>
            <p><b><?= $lang["Reportcatetorias3get"] ?>: </b><?= date('d/m/Y H:i:s', is_numeric($news2['time']) ? $news2['time'] : strtotime($news2['time'])); ?></p>
            <p><b><?= $lang["Reportcatetorias4get"] ?>: </b><?= filter($news2['staff']); ?></p>
        </div>

    <?php
    } else {
        echo '<h2 class="page-content-collider-content-news-right-side-content-title">' . $lang["Reportnotfoundget"] . ' »</h2>';
        echo '<p>' . $lang["Reportnotexistget"] . '</p>';
        exit;
    }
    ?>
  </div>

  <div class="page-content-collider-content-news-right-side-content">

    <?php
    $messages = [];
    
    try {
        // ========== OBTENER PREGUNTAS DEL USUARIO ==========
        // ¡CORREGIDO! El campo es "user", no "author"
        $questionsStmt = $dbh->prepare("
            SELECT 
                q.id,
                q.question AS message,
                q.time,
                q.user AS username,
                u.look AS user_look
            FROM cms_reports_newquestion q
            LEFT JOIN users u ON u.username = q.user
            WHERE q.report_id = :id
        ");
        $questionsStmt->bindValue(':id', $reportId, PDO::PARAM_INT);
        $questionsStmt->execute();
        $questions = $questionsStmt->fetchAll(PDO::FETCH_ASSOC);
        
        // ========== OBTENER RESPUESTAS DEL STAFF ==========
        $repliesStmt = $dbh->prepare("
            SELECT 
                r.id,
                r.reply AS message,
                r.time,
                r.staff AS username,
                u.look AS user_look
            FROM cms_reportsreply r
            LEFT JOIN users u ON u.username = r.staff
            WHERE r.report_id = :id
        ");
        $repliesStmt->bindValue(':id', $reportId, PDO::PARAM_INT);
        $repliesStmt->execute();
        $replies = $repliesStmt->fetchAll(PDO::FETCH_ASSOC);
        
        // ========== COMBINAR ==========
        foreach ($questions as $q) {
            $messages[] = [
                'message'   => $q['message'] ?? '',
                'timestamp' => (int)$q['time'],
                'username'  => $q['username'] ?? 'Usuario',
                'user_look' => $q['user_look'] ?? '',
                'role'      => 'user'
            ];
        }
        
        foreach ($replies as $r) {
            $messages[] = [
                'message'   => $r['message'] ?? '',
                'timestamp' => (int)$r['time'],
                'username'  => $r['username'] ?? 'Staff',
                'user_look' => $r['user_look'] ?? '',
                'role'      => 'staff'
            ];
        }
        
        // Ordenar por tiempo
        usort($messages, function($a, $b) {
            return $a['timestamp'] <=> $b['timestamp'];
        });
        
    } catch (PDOException $e) {
        error_log("Error cargando mensajes: " . $e->getMessage());
    }

    // ========== MOSTRAR CHAT ==========
    if (count($messages) > 0) {
        echo '<div class="help-chat">';
        
        foreach ($messages as $msg) {
            $isStaff = ($msg['role'] === 'staff');
            $name = filter($msg['username']);
            $time = date('d/m/Y H:i:s', $msg['timestamp']);
            
            // Avatar
            $look = $msg['user_look'] ?? '';
            if (!empty($look)) {
                $avatarUrl = $config['AvatarURL'] . $look . '&direction=2&head_direction=3&gesture=sml&size=s';
            } else {
                $avatarUrl = $config['AvatarURL'] . 'hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-91&direction=2&head_direction=3&gesture=sml&size=s';
            }
            
            $bubbleClass = $isStaff ? 'help-chat-message--staff' : 'help-chat-message--user';
            ?>
            <div class="help-chat-message <?= $bubbleClass ?>">
                <div class="help-chat-avatar">
                    <img src="<?= htmlspecialchars($avatarUrl) ?>" alt="<?= htmlspecialchars($name) ?>">
                </div>
                <div class="help-chat-bubble">
                    <div class="help-chat-meta">
                        <strong><?= htmlspecialchars($name) ?></strong>
                        <?php if ($isStaff): ?>
                            <span style="background:#4CAF50;color:#fff;padding:1px 6px;border-radius:3px;font-size:9px;margin-left:5px;">STAFF</span>
                        <?php endif; ?>
                        <span class="help-chat-time"><?= htmlspecialchars($time) ?></span>
                    </div>
                    <div class="help-chat-text"><?= nl2br(htmlspecialchars($msg['message'])) ?></div>
                </div>
            </div>
            <?php
        }
        
        echo '</div>';
        
    } else {
        echo '<div class="help-chat">';
        echo '<div class="help-chat-message help-chat-message--system">';
        echo '  <div class="help-chat-bubble">';
        echo '    <div class="help-chat-meta"><strong>' . htmlspecialchars($config['site_name'] ?? 'Sistema') . '</strong></div>';
        echo '    <div class="help-chat-text">' . nl2br(htmlspecialchars($lang["Reportresponsesdescget"] ?? 'Hasta el momento no hay mensajes.')) . '</div>';
        echo '  </div>';
        echo '</div>';
        echo '</div>';
    }
    ?>

  </div>

  <?php if ($news2['state'] == 'Abierto' || $news2['state'] == 'Tratamiento') { ?>
    <div class="page-content-collider-content-news-right-side-content" style="margin-top: 50px;">
      <div class="page-content-collider-content-settings-right-side-item">
        <div class="page-content-collider-content-settings-right-side-item-column">

          <h3 class="page-content-collider-content-settings-right-side-item-title"><?= $lang["Reportrespondereportget"] ?></h3>

          <?php User::ReportNewQuestion(); ?>
          <form action="" method="POST">
            <textarea name="question" id="newquestion_text" class="help-custom-textarea" placeholder="Escribe tu nueva pregunta" required></textarea>
            <p class="page-content-collider-content-settings-right-side-item-description"><?= $lang["Reportquestionuserget"] ?></p>

            <input type="hidden" name="report_id" id="newquestion_hidden" value="<?= $news2['id'] ?>">
            <button type="submit" name="newquestion" id="newquestion_btn" autocomplete="off" class="help-submit-btn" style="margin-top:10px;"><?= $lang["SettingsButton"] ?></button>
          </form>

        </div>
      </div>
    </div>
  <?php } ?>

</div>