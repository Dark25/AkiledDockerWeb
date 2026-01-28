<!DOCTYPE html>
<html lang="en">
<?php
include_once "includes/head.php";
$_SESSION['title'] = '';
$_SESSION['slogan'] = '';
$_SESSION['news'] = '';
admin::CheckRank(13);
?>

<body>

  <?php
  include_once "includes/navi.php";
  include_once "includes/header.php";
  ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Reportes Abiertos y en Tratamiento</h4>
            <p class="card-description"> <code>(Responda las llamadas a continuación si no tiene staff respondiendo.)</code></p>

            <?php 
                if (isset($_GET['delete'])) {
                    admin::DeleteReport(); 
                }
            ?>



            <div class="table-responsive">
              <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Autor</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $getArticles = $dbh->prepare("SELECT * FROM cms_reports WHERE state != 'Cerrado' ORDER BY id DESC");
                $getArticles->execute();
                if ($getArticles->rowCount() == 0) {
                    echo '<tr><td colspan="6" class="text-center">No hay reportes abiertos.</td></tr>';
                }
                while ($news = $getArticles->fetch()) {
                    $stateBadge = ($news["state"] == 'Abierto') ? 'badge-outline-success' : 'badge-outline-warning';
                ?>
                    <tr>
                      <td>#<?= filter($news["id"]) ?></td>
                      <td><?= filter($news["title"]) ?></td>
                      <td><span class="badge badge-outline-info"><?= filter($news["category"]) ?></span></td>
                      <td><label class="badge <?= $stateBadge ?>"><?= filter($news["state"]) ?></label></td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="mr-2" style="width: 30px; height: 30px; border-radius: 50%; background: #2a3038; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            <img src="<?= $config['lookUrl'] . User::GetLookByUsername($news['author']) ?>&direction=2&head_direction=2&gesture=sml&size=l" style="width: 89%; height: 89%; object-fit: cover; object-position: center 20%; transform: scale(2.5);">
                          </div>
                          <span><?= filter($news["author"]) ?></span>
                        </div>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-primary btn-sm" href="/adminpan/replyreport/<?= $news["id"] ?>">
                            <i class="mdi mdi-comment-text-outline"></i> Responder
                          </a>
                          <a class="btn btn-danger btn-sm" href="/adminpan/report/delete/<?= $news["id"] ?>" onclick="return confirm('¿Estás seguro de eliminar este reporte?')">
                            <i class="mdi mdi-delete"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content-wrapper">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Reportes Cerrados</h4>
            <p class="card-description"> <code>(Reportes que ya han sido cerradas)</code></p>





            <div class="table-responsive">
              <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Autor</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $getArticles = $dbh->prepare("SELECT * FROM cms_reports WHERE state = 'Cerrado' ORDER BY id DESC");
                $getArticles->execute();
                if ($getArticles->rowCount() == 0) {
                    echo '<tr><td colspan="6" class="text-center">No hay reportes cerrados.</td></tr>';
                }
                while ($news = $getArticles->fetch()) {
                ?>
                    <tr>
                      <td>#<?= filter($news["id"]) ?></td>
                      <td><?= filter($news["title"]) ?></td>
                      <td><span class="badge badge-outline-info"><?= filter($news["category"]) ?></span></td>
                      <td><label class="badge badge-outline-danger"><?= filter($news["state"]) ?></label></td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="mr-2" style="width: 30px; height: 30px; border-radius: 50%; background: #2a3038; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            <img src="<?= $config['lookUrl'] . User::GetLookByUsername($news['author']) ?>&direction=2&head_direction=2&gesture=sml&size=l" style="width: 100%; height: 100%; object-fit: cover; object-position: center 20%; transform: scale(2.5);">
                          </div>
                          <span><?= filter($news["author"]) ?></span>
                        </div>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-info btn-sm" href="/adminpan/viewreportclosed/<?= $news["id"] ?>">
                            <i class="mdi mdi-eye"></i> Ver
                          </a>
                          <a class="btn btn-danger btn-sm" href="/adminpan/report/delete/<?= $news["id"] ?>" onclick="return confirm('¿Estás seguro de eliminar este reporte?')">
                            <i class="mdi mdi-delete"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <?php
      include_once "includes/footer.php";
      ?>

</body>

</html>