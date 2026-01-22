<?php
// Validación
if (empty($_GET['id']) || !is_numeric($_GET['id'])) exit('<h2>' . $lang["Nnotfoundheader"] . '</h2><p>' . $lang["Nnotfoundtxt"] . '</p>');

$reportId = (int)$_GET['id'];
$news = $dbh->prepare("SELECT * FROM cms_reports WHERE id = :id");
$news->execute([':id' => $reportId]);

if ($news->rowCount() != 1) exit('<h2>' . $lang["Reportnotfoundget"] . '</h2><p>' . $lang["Reportnotexistget"] . '</p>');

$report = $news->fetch();
include_once("getButtons.php");

function buildAvatarUrl($config, $look, $size = 's') {
    $look = trim($look) ?: 'hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-91';
    return htmlspecialchars($config['AvatarURL'] . rawurlencode($look) . '&direction=2&head_direction=3&gesture=sml&size=' . $size, ENT_QUOTES, 'UTF-8');
}

$author = $dbh->prepare("SELECT * FROM users WHERE username = :author");
$author->execute([':author' => $report['author']]);
$author = $author->fetch();
$statusClass = $report['state']=='Abierto' ? 'status-open' : ($report['state']=='Tratamiento' ? 'status-progress' : 'status-closed');
?>

<div class="page-content-collider-content-news-right-side">
  <div class="page-content-collider-content-news-right-side-content">
    <div class="help-card-header">
      <h2 class="help-card-main-title"><?= $lang["ReportTituloGet"] ?>: <?= filter($report["title"]) ?></h2>
      <p class="help-card-main-subtitle"><?= $lang["Reportcatetorias1get"] ?>: <?= filter($report['category']) ?></p>
      <span class="help-header-badge <?= $statusClass ?>"><?= filter($report['state']) ?></span>
      <?php if ($author): ?>
        <div class="help-author">
          <span class="help-author-figure"><img src="<?= buildAvatarUrl($config, $author['look'], 'b') ?>" alt="<?= htmlspecialchars(filter($author['username'])) ?>" loading="lazy" width="80" height="80"></span>
          <div class="help-author-name"><?= htmlspecialchars(filter($author['username'])) ?></div>
        </div>
      <?php endif; ?>
    </div>
    <div class="help-main-body">
      <p><b><?= $lang["Reportcatetorias2get"] ?>: </b><?= filter($report['problem']) ?></p>
      <p><b><?= $lang["Reportcatetorias3get"] ?>: </b><?= date('d/m/Y H:i:s', is_numeric($report['time']) ? $report['time'] : strtotime($report['time'])) ?></p>
      <p><b><?= $lang["Reportcatetorias4get"] ?>: </b><?= filter($report['staff']) ?></p>
    </div>
  </div>

  <div class="page-content-collider-content-news-right-side-content">
    <?php
    $questions = $dbh->prepare("SELECT q.question AS message, q.time, q.user AS username, u.look AS user_look FROM cms_reports_newquestion q LEFT JOIN users u ON u.username = q.user WHERE q.report_id = :id");
    $questions->execute([':id' => $reportId]);
    $replies = $dbh->prepare("SELECT r.reply AS message, r.time, r.staff AS username, u.look AS user_look FROM cms_reportsreply r LEFT JOIN users u ON u.username = r.staff WHERE r.report_id = :id");
    $replies->execute([':id' => $reportId]);
    
    $messages = [];
    foreach ($questions->fetchAll(PDO::FETCH_ASSOC) as $q) $messages[] = array_merge($q, ['role' => 'user']);
    foreach ($replies->fetchAll(PDO::FETCH_ASSOC) as $r) $messages[] = array_merge($r, ['role' => 'staff']);
    usort($messages, fn($a, $b) => (int)$a['time'] <=> (int)$b['time']);
    $messageCount = count($messages);

    if ($messages): ?>
      <div class="help-chat-container">
        <div class="help-chat-header">
          <span class="help-chat-header-title"><i class="fas fa-comments"></i> <?= $lang["Reportresponsesget"] ?? 'Conversación' ?></span>
          <span class="help-chat-header-count"><?= $messageCount ?> <?= $messageCount === 1 ? 'mensaje' : 'mensajes' ?></span>
        </div>
        <div class="help-chat-scroll" id="chatScroll">
          <div class="help-chat">
            <?php foreach ($messages as $msg): $isStaff = $msg['role'] === 'staff'; ?>
              <div class="help-chat-message <?= $isStaff ? 'help-chat-message--staff' : 'help-chat-message--user' ?>">
                <div class="help-chat-avatar"><img src="<?= buildAvatarUrl($config, $msg['user_look'] ?? '', 'b') ?>" alt="<?= htmlspecialchars(filter($msg['username'] ?? '')) ?>" loading="lazy" width="64" height="64"></div>
                <div class="help-chat-bubble">
                  <div class="help-chat-meta">
                    <strong><?= htmlspecialchars(filter($msg['username'] ?? ($isStaff ? 'Staff' : 'Usuario'))) ?></strong>
                    <?php if ($isStaff): ?><span style="background:#4CAF50;color:#fff;padding:1px 6px;border-radius:3px;font-size:9px;margin-left:5px;">STAFF</span><?php endif; ?>
                    <span class="help-chat-time"><?= date('d/m/Y H:i:s', (int)$msg['time']) ?></span>
                  </div>
                  <div class="help-chat-text"><?= nl2br(htmlspecialchars($msg['message'] ?? '')) ?></div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="help-chat-overlay" id="chatOverlay"></div>
        <?php if ($messageCount > 3): ?><div class="help-chat-scroll-indicator" id="scrollIndicator" onclick="scrollToBottom()"><i class="fas fa-chevron-down"></i> Scroll para ver más</div><?php endif; ?>
      </div>
      <script>
      document.addEventListener('DOMContentLoaded', function() {
          const chatScroll = document.getElementById('chatScroll');
          const chatOverlay = document.getElementById('chatOverlay');
          const scrollIndicator = document.getElementById('scrollIndicator');
          
          function updateOverlay() {
              const isAtBottom = chatScroll.scrollHeight - chatScroll.scrollTop <= chatScroll.clientHeight + 10;
              if (chatOverlay) chatOverlay.style.opacity = isAtBottom ? '0' : '1';
              if (scrollIndicator) {
                  scrollIndicator.style.opacity = isAtBottom ? '0' : '1';
                  scrollIndicator.style.pointerEvents = isAtBottom ? 'none' : 'auto';
              }
          }
          
          chatScroll.addEventListener('scroll', updateOverlay);
          updateOverlay();
          chatScroll.scrollTop = chatScroll.scrollHeight;
          setTimeout(updateOverlay, 100);
      });
      
      function scrollToBottom() {
          document.getElementById('chatScroll').scrollTo({top: document.getElementById('chatScroll').scrollHeight, behavior: 'smooth'});
      }
      </script>
    <?php else: ?>
      <div class="help-chat-container">
        <div class="help-chat-scroll">
          <div class="help-chat"><div class="help-chat-message help-chat-message--system"><div class="help-chat-bubble">
            <div class="help-chat-meta"><strong><?= htmlspecialchars($config['site_name'] ?? 'Sistema') ?></strong></div>
            <div class="help-chat-text"><?= nl2br(htmlspecialchars($lang["Reportresponsesdescget"] ?? 'No hay mensajes.')) ?></div>
          </div></div></div>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <?php if ($report['state'] == 'Abierto' || $report['state'] == 'Tratamiento'): ?>
    <div class="page-content-collider-content-news-right-side-content" style="margin-top: 50px;">
      <div class="page-content-collider-content-settings-right-side-item">
        <div class="page-content-collider-content-settings-right-side-item-column">
          <h3 class="page-content-collider-content-settings-right-side-item-title"><?= $lang["Reportrespondereportget"] ?></h3>
          <?php User::ReportNewQuestion(); ?>
          <form action="" method="POST">
            <textarea name="question" id="newquestion_text" class="help-custom-textarea" placeholder="Escribe tu nueva pregunta" required></textarea>
            <input type="hidden" name="report_id" id="newquestion_hidden" value="<?= $report['id'] ?>">
            <button type="submit" name="newquestion" id="newquestion_btn" class="help-submit-btn" style="margin-top:10px;"><?= $lang["SettingsButton"] ?></button>
          </form>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>