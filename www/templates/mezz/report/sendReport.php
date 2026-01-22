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

    <div class="help-form-group">
      <label class="help-label" for="report_title">Título del Report:</label>
      <input type="text" name="title" id="report_title" class="page-content-collider-content-settings-right-side-item-input" placeholder="Título del Report" style="width: 100%;">
      <span class="help-input-desc">Ingrese un título descriptivo para su problema.</span>
    </div>

    <div class="help-form-group">
      <label class="help-label" for="report_category">Categoría:</label>
      <select name="category" id="report_category" class="page-content-collider-content-settings-right-side-item-input" style="width: 100%;">
        <option value="Problema tecnico"><?= $lang["ReportOption1"] ?></option>
        <option value="Problema en la tienda"><?= $lang["ReportOption1"] ?></option>
        <option value="Problema de Moderación"><?= $lang["ReportOption2"] ?></option>
        <option value="Problema con los furnis"><?= $lang["ReportOption3"] ?></option>
        <option value="Furnis faltantes"><?= $lang["ReportOption4"] ?></option>
        <option value="Reportar un Staff"><?= $lang["ReportOption5"] ?></option>
        <option value="Sugerencias"><?= $lang["ReportOption6"] ?></option>
      </select>
      <span class="help-input-desc">Elija la categoría que mejor se adapte a su problema.</span>
    </div>

    <div class="help-form-group">
      <label class="help-label" for="report_problem">Describe tu Problema:</label>
      <textarea name="problem" id="report_problem" class="page-content-collider-content-settings-right-side-item-input" placeholder="<?= $lang["ReportTituloComent"] ?>" style="width: 100%; min-height: 150px;"></textarea>
      <span class="help-input-desc">Escribe tu problema en detalle para que nuestro equipo pueda ayudarte mejor.</span>
    </div>

    <div class="help-save-container">
        <button type="submit" name="report" class="page-content-collider-content-settings-right-side-default-button fill save" style="padding: 15px 40px; font-size: 16px;">Guardar</button>
    </div>

  </div>

</form>
