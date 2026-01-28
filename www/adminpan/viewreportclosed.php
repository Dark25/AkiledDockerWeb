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

            <?php if (admin::ViewReport("state") == "Cerrado") { ?>

                <div class="page-header">
                    <h3 class="page-title text-muted"> Histórico de Reporte: <span class="text-white"><?php echo admin::ViewReport("title"); ?></span></h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/adminpan/report">Reportes</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detalles Finales</li>
                        </ol>
                    </nav>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8 grid-margin stretch-card">
                        <div class="card shadow-sm border-danger">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid #0090e7; background: #191c24; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                            <img src="<?= $config['lookUrl'] . User::GetLookByUsername(admin::ViewReport("author")) ?>&direction=2&head_direction=2&gesture=sml&size=l" style="width: 89%; height: 89%; object-fit: cover; object-position: center 20%; transform: scale(2.5);">
                                        </div>
                                        <div>
                                            <h4 class="card-title text-danger mb-0">
                                                <i class="mdi mdi-lock-outline mr-2"></i>REPORTE CERRADO
                                            </h4>
                                            <small class="text-muted">Autor: <?= admin::ViewReport("author") ?></small>
                                        </div>
                                    </div>
                                    <span class="badge badge-outline-danger">Caso #<?php echo admin::ViewReport("id"); ?></span>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-muted small text-uppercase font-weight-bold">Asunto</label>
                                            <p class="lead"><?php echo admin::ViewReport("title"); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="form-group">
                                            <label class="text-muted small text-uppercase font-weight-bold">Categoría</label>
                                            <div><span class="badge badge-pill badge-outline-info"><?php echo admin::ViewReport("category"); ?></span></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-muted small text-uppercase font-weight-bold">Reporte Original del Usuario</label>
                                    <div class="bg-dark p-4 rounded text-white-50 border border-secondary shadow-inner">
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
                                    echo '<div class="chat-history-container bg-dark p-4 rounded mb-5 border border-secondary" style="max-height: 600px; overflow-y: auto;">';
                                    foreach ($messages as $msg) {
                                        $isStaff = $msg['role'] === 'staff';
                                ?>
                                    <div class="d-flex <?= $isStaff ? 'justify-content-start' : 'justify-content-end' ?> mb-4">
                                        <div class="d-flex <?= $isStaff ? 'flex-row' : 'flex-row-reverse' ?> align-items-end" style="max-width: 85%;">
                                            <div class="chat-avatar mx-2" style="width: 45px; height: 45px; border-radius: 50%; background: #191c24; border: 2px solid <?= $isStaff ? '#00d25b' : '#0090e7' ?>; box-shadow: 0 4px 8px rgba(0,0,0,0.3); overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <img src="<?= $config['lookUrl'] . $msg['look'] ?>&direction=2&head_direction=2&gesture=sml&size=l" style="width: 89%; height: 89%; object-fit: cover; object-position: center 20%; transform: scale(2.8);">
                                            </div>
                                            <div class="chat-bubble p-3 shadow-sm" style="background: <?= $isStaff ? '#2a3038' : '#0090e7' ?>; color: #fff; border-radius: 20px !important; border-bottom-<?= $isStaff ? 'left' : 'right' ?>-radius: 5px !important;">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <small class="font-weight-bold mr-4" style="color: <?= $isStaff ? '#00d25b' : '#b1d9ff' ?>;"><?= $msg['username'] ?> <?= $isStaff ? '<span class="badge badge-success badge-xs ml-1">STAFF</span>' : '' ?></small>
                                                    <small class="text-muted" style="font-size: 10px;"><?= date('d/m H:i', $msg['time']) ?></small>
                                                </div>
                                                <div class="chat-text" style="font-size: 14px; line-height: 1.4;">
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

                                <hr class="my-5 border-secondary">



                                <div class="row mt-5 pt-3 border-top">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <div class="preview-thumbnail mr-3" style="width: 50px; height: 50px; background: #191c24; border-radius: 50%; border: 2px solid #00d25b; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <img src="<?= $config['lookUrl'] . User::GetLookByUsername(admin::ViewReport("staff")) ?>&direction=2&head_direction=2&gesture=sml&size=l" style="width: 89%; height: 89%; object-fit: cover; object-position: center 20%; transform: scale(2.5);">
                                            </div>
                                            <div>
                                                <p class="text-muted small mb-0">Atendido por</p>
                                                <p class="text-primary font-weight-bold mb-0"><?php echo admin::ViewReport("staff"); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <p class="text-muted small mb-0">Fecha de Cierre</p>
                                        <p class="text-white mb-0"><?php echo date('d M, Y - H:i', admin::ViewReport("time")); ?></p>
                                    </div>
                                </div>
                                
                                <div class="text-center mt-5">
                                    <a href="/adminpan/report" class="btn btn-outline-light">
                                        <i class="mdi mdi-arrow-left"></i> Volver al listado
                                    </a>
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
</body>


</html>