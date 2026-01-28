<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/head.php";
admin::CheckRank(19);
?>

<body>

    <?php
    include_once "includes/navi.php";
    include_once "includes/header.php";
    ?>


    <div class="main-panel">
        <div class="content-wrapper">

            <?php if (admin::ViewReport("state") == "Abierto" || admin::ViewReport("state") == "Tratamiento" || admin::ViewReport("state") == "") { ?>

                <div class="page-header">
                    <h3 class="page-title"> Gestionar Reporte: <span class="text-primary"><?php echo admin::ViewReport("title"); ?></span></h3>
                </div>
                <div class="row">
                    <div class="col-md-7 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3" style="width: 45px; height: 45px; border-radius: 50%; border: 2px solid #0090e7; overflow: hidden; background: #2a3038; display: flex; align-items: center; justify-content: center;">
                                            <img src="<?= $config['lookUrl'] . User::GetLookByUsername(admin::ViewReport("author")) ?>&direction=2&head_direction=2&gesture=sml&size=l" style="width: 89%; height: 89%; object-fit: cover; object-position: center 20%; transform: scale(2.5);">
                                        </div>
                                        <div>
                                            <h4 class="card-title mb-0">Detalles del Caso</h4>
                                            <small class="text-muted">Iniciado por <?= admin::ViewReport("author") ?></small>
                                        </div>
                                    </div>
                                    <span class="badge badge-outline-info">ID #<?php echo admin::ViewReport("id"); ?></span>
                                </div>

                                <div class="form-group border-bottom pb-2">
                                    <label class="text-muted small">Título del Reporte</label>
                                    <p class="font-weight-bold"><?php echo admin::ViewReport("title"); ?></p>
                                </div>

                                <div class="form-group border-bottom pb-2">
                                    <label class="text-muted small">Categoría</label>
                                    <p><span class="badge badge-pill badge-outline-primary"><?php echo admin::ViewReport("category"); ?></span></p>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-muted small">Descripción del Problema</label>
                                    <div class="bg-dark p-3 rounded text-light">
                                        <?php echo nl2br(admin::ViewReport("problem")); ?>
                                    </div>
                                </div>

                                <?php
                                $idpage = $_GET['id'];
                                $questions = $dbh->prepare("SELECT q.question AS message, q.time, q.user AS username, u.look FROM cms_reports_newquestion q LEFT JOIN users u ON u.username = q.user WHERE q.report_id = :id");
                                $questions->execute([':id' => $idpage]);
                                $replies = $dbh->prepare("SELECT r.reply AS message, r.time, r.staff AS username, u.look FROM cms_reportsreply r LEFT JOIN users u ON u.username = r.staff WHERE r.report_id = :id");
                                $replies->execute([':id' => $idpage]);

                                $messages = [];
                                foreach ($questions->fetchAll() as $q) $messages[] = array_merge($q, ['role' => 'user']);
                                foreach ($replies->fetchAll() as $r) $messages[] = array_merge($r, ['role' => 'staff']);
                                usort($messages, fn($a, $b) => $a['time'] <=> $b['time']);

                                if ($messages) {
                                    echo '<div id="report-chat-content" class="chat-container bg-dark p-3 rounded mb-4" style="max-height: 500px; overflow-y: auto;">';
                                    // Los mensajes se cargarán dinámicamente o inicialmente por PHP
                                    foreach ($messages as $msg) {
                                        $isStaff = $msg['role'] === 'staff';
                                        $look = $msg['look'] ?: 'hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-91';
                                ?>
                                    <div class="d-flex <?= $isStaff ? 'justify-content-start' : 'justify-content-end' ?> mb-3">
                                        <div class="d-flex <?= $isStaff ? 'flex-row' : 'flex-row-reverse' ?> align-items-end" style="max-width: 80%;">
                                            <div class="chat-avatar mx-2" style="width: 40px; height: 40px; border-radius: 50%; background: #2a3038; border: 2px solid <?= $isStaff ? '#00d25b' : '#0090e7' ?>; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <img src="<?= $config['lookUrl'] . $look ?>&direction=2&head_direction=2&gesture=sml&size=l" style="width: 89%; height: 89%; object-fit: cover; object-position: center 20%; transform: scale(2.8);">
                                            </div>
                                            <div class="chat-bubble p-3 rounded" style="background: <?= $isStaff ? '#2a3038' : '#0090e7' ?>; color: #fff; border: 1px solid <?= $isStaff ? '#444' : '#0070c0' ?>; border-radius: 15px !important;">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <small class="font-weight-bold mr-3" style="color: <?= $isStaff ? '#00d25b' : '#b1d9ff' ?>;"><?= $msg['username'] ?> <?= $isStaff ? '<span class="badge badge-success badge-xs">STAFF</span>' : '' ?></small>
                                                    <small class="text-muted" style="font-size: 10px;"><?= date('H:i', $msg['time']) ?></small>
                                                </div>
                                                <div class="chat-text">
                                                    <?= nl2br(filter($msg['message'])) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }
                                    echo '</div>';
                                }
                                ?>


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Acciones de Staff</h4>
                                
                                <form id="reply-form" class="forms-sample mb-4" action="" method="POST">
                                    <div class="form-group">
                                        <label><b>Enviar Respuesta al Usuario</b></label>
                                        <textarea name="reply" class="form-control" rows="6" placeholder="Escribe aquí tu respuesta detallada..."></textarea>
                                    </div>
                                    <input type="hidden" name="report_id" value="<?php echo admin::ViewReport("id") ?>">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="mdi mdi-send"></i> Enviar Respuesta
                                    </button>
                                </form>

                                <hr class="my-4">

                                <form class="forms-sample" action="" method="POST">
                                    <?php admin::ChangeStatusReport("id"); ?>
                                    <div class="form-group">
                                        <label><b>Cambiar Estado del Reporte</b></label>
                                        <select name="state" class="form-control text-white">
                                            <option value="Abierto" <?php echo admin::ViewReport("state") == 'Abierto' ? 'selected' : ''; ?>>🟢 Abierto</option>
                                            <option value="Tratamiento" <?php echo admin::ViewReport("state") == 'Tratamiento' ? 'selected' : ''; ?>>🟡 En Tratamiento</option>
                                            <option value="Cerrado" <?php echo admin::ViewReport("state") == 'Cerrado' ? 'selected' : ''; ?>>🔴 Cerrado</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="staff" value="<?php echo User::userData("username") ?>">
                                    <button name="statusreport" type="submit" class="btn btn-success btn-block">
                                        <i class="mdi mdi-check-circle-outline"></i> Actualizar Estado
                                    </button>
                                </form>
                                
                                <div class="mt-4 p-3 rounded small" style="background: rgba(0, 210, 255, 0.1); border: 1px solid rgba(0, 210, 255, 0.2); color: #00d2ff;">
                                    <i class="mdi mdi-information-outline"></i> <strong>Nota:</strong> Al cerrar un reporte, este se moverá a la sección de históricos.
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } else { ?>

                    <div class="page-header">
                        <div class="form-group">
                            <label for="exampleInputName1">¡Este ticket ya ha sido cerrado o no existe!</label>
                        </div>
                    </div>

                <?php } ?>

                </div>

        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php
        include_once "includes/footer.php";
        ?>
        <!-- container-scroller -->

        <!-- End custom js for this page -->
        <script>
        function updateChat() {
            var reportId = '<?= admin::ViewReport("id") ?>';
            fetch('/adminpan/get_report_messages.php?id=' + reportId)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('report-chat-content');
                    if (!container || !data.messages) return;
                    
                    let html = '';
                    data.messages.forEach(msg => {
                        const isStaff = msg.role === 'staff';
                        const time = new Date(msg.time * 1000).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                        const border = isStaff ? '#00d25b' : '#0090e7';
                        const bg = isStaff ? '#2a3038' : '#0090e7';
                        const borderColor = isStaff ? '#444' : '#0070c0';
                        const nameColor = isStaff ? '#00d25b' : '#b1d9ff';
                        
                        html += `
                        <div class="d-flex ${isStaff ? 'justify-content-start' : 'justify-content-end'} mb-3">
                            <div class="d-flex ${isStaff ? 'flex-row' : 'flex-row-reverse'} align-items-end" style="max-width: 80%;">
                                <div class="chat-avatar mx-2" style="width: 40px; height: 40px; border-radius: 50%; background: #2a3038; border: 2px solid ${border}; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <img src="${data.lookUrl}${msg.look}&direction=2&head_direction=2&gesture=sml&size=l" style="width: 89%; height: 89%; object-fit: cover; object-position: center 20%; transform: scale(2.8);">
                                </div>
                                <div class="chat-bubble p-3 rounded" style="background: ${bg}; color: #fff; border: 1px solid ${borderColor}; border-radius: 15px !important;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <small class="font-weight-bold mr-3" style="color: ${nameColor};">${msg.username} ${isStaff ? '<span class="badge badge-success badge-xs">STAFF</span>' : ''}</small>
                                        <small class="text-muted" style="font-size: 10px;">${time}</small>
                                    </div>
                                    <div class="chat-text">
                                        ${msg.message.replace(/\n/g, '<br>')}
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    });

                    const currentHtml = container.innerHTML;
                    if (currentHtml.length !== html.length) {
                        const wasAtBottom = container.scrollHeight - container.scrollTop <= container.clientHeight + 50;
                        container.innerHTML = html;
                        if (wasAtBottom) {
                            container.scrollTop = container.scrollHeight;
                        }
                    }
                })
                .catch(err => console.error('Error al actualizar chat:', err));
        }

        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('report-chat-content');
            if(container) container.scrollTop = container.scrollHeight;
            setInterval(updateChat, 3000);

            const replyForm = document.getElementById('reply-form');
            if (replyForm) {
                replyForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const textarea = this.querySelector('textarea[name="reply"]');
                    if (!textarea.value.trim()) {
                        alert('Debes escribir una respuesta');
                        return;
                    }

                    const formData = new FormData(this);
                    formData.append('postreply', 'true');

                    fetch('/adminpan/post_report_reply.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('HTTP error ' + response.status);
                        return response.text();
                    })
                    .then(text => {
                        try {
                            const data = JSON.parse(text);
                            if (data.status === 'success') {
                                textarea.value = '';
                                updateChat();
                            } else {
                                alert('Error: ' + (data.message || 'Desconocido'));
                            }
                        } catch (e) {
                            console.error('Respuesta mal formada:', text);
                            throw new Error('Respuesta del servidor no válida (JSON)');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al enviar mensaje: ' + error.message);
                    });
                });
            }
        });
        </script>
    </body>
</html>