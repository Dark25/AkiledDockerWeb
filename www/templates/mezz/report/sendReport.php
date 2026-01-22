<form action="" method="POST">

  <?php
  User::CreateReport();

  $getReport = $dbh->prepare("SELECT * FROM cms_reports WHERE id = :id");
  $getReport->bindParam(':id', $_SESSION['id']);
  $getReport->execute();
  $report = $getReport->fetch();
  ?>

  <div class="help-card">

    <input type="hidden" id="content" name="author" value="<?php echo User::userData("username") ?>">

    <div class="page-content-collider-content-settings-right-side-item">
      <div class="page-content-collider-content-settings-right-side-item-column" style="width: 100%;">
        <h3 class="page-content-collider-content-settings-right-side-item-title"><?= $lang["TitutloReport"] ?>:</h3>
        <input type="text" name="title" id="report" class="page-content-collider-content-settings-right-side-item-input" placeholder="Título del Report" style="width: 100%;">
        <p class="page-content-collider-content-settings-right-side-item-description"><?= $lang["Descriporeport"] ?></p>
      </div>
    </div>

    <div class="page-content-collider-content-settings-right-side-item">
      <div class="page-content-collider-content-settings-right-side-item-column" style="width: 100%;">
        <h3 class="page-content-collider-content-settings-right-side-item-title"><?= $lang["TituloReportCategoria"] ?></h3>
        <select name="category" id="report" class="page-content-collider-content-settings-right-side-item-input" style="width: 100%;">
          <option value="Problema tecnico"><?= $lang["ReportOption1"] ?></option>
          <option value="Problema en la tienda"><?= $lang["ReportOption1"] ?></option>
          <option value="Problema de Moderación"><?= $lang["ReportOption2"] ?></option>
          <option value="Problema con los furnis"><?= $lang["ReportOption3"] ?></option>
          <option value="Furnis faltantes"><?= $lang["ReportOption4"] ?></option>
          <option value="Reportar un Staff"><?= $lang["ReportOption5"] ?></option>
          <option value="Sugerencias"><?= $lang["ReportOption6"] ?></option>
        </select>
        <p class="page-content-collider-content-settings-right-side-item-description"><?= $lang["ReportDescOptions"] ?></p>
      </div>
    </div>

    <div class="page-content-collider-content-settings-right-side-item">
      <div class="page-content-collider-content-settings-right-side-item-column" style="width: 100%;">
        <h3 class="page-content-collider-content-settings-right-side-item-title"><?= $lang["ReportTituloComent"] ?></h3>
        <textarea type="text" name="problem" id="report" class="page-content-collider-content-settings-right-side-item-input" placeholder="<?= $lang["ReportTituloComent"] ?>" style="width: 100%; min-height: 100px;"></textarea>
        <p class="page-content-collider-content-settings-right-side-item-description"><?= $lang["ReportDescDetail"] ?></p>
      </div>
    </div>

    <div style="width: 100%; display: flex; justify-content: flex-end;">
        <button type="submit" name="report" id="report" autocomplete="off" class="page-content-collider-content-settings-right-side-default-button fill save"><?= $lang["SettingsButton"] ?></button>
    </div>

  </div>

</form>
