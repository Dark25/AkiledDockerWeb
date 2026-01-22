<div class="help-form-container">
  <?php
  User::CreateReport();
  ?>

  <form action="" method="POST" class="help-report-form">
    <input type="hidden" id="content" name="author" value="<?php echo User::userData("username") ?>">

    <div class="help-form-field">
      <label class="help-form-label" for="report_title"><i class="fas fa-tag mr-2"></i>Título del Reporte</label>
      <div class="help-input-wrapper">
        <input type="text" name="title" id="report_title" class="help-custom-input" placeholder="Ej: Problema con la carga de furnis" required>
      </div>
      <p class="help-field-desc">Resume tu problema en pocas palabras.</p>
    </div>

    <div class="help-form-field">
      <label class="help-form-label" for="report_category"><i class="fas fa-list mr-2"></i>Categoría del problema</label>
      <div class="help-input-wrapper">
        <select name="category" id="report_category" class="help-custom-select" required>
          <option value="" disabled selected>Selecciona una categoría...</option>
          <option value="Problema tecnico"><?= $lang["ReportOption1"] ?></option>
          <option value="Problema en la tienda">Problema en la tienda</option>
          <option value="Problema de Moderación"><?= $lang["ReportOption2"] ?></option>
          <option value="Problema con los furnis"><?= $lang["ReportOption3"] ?></option>
          <option value="Furnis faltantes"><?= $lang["ReportOption4"] ?></option>
          <option value="Reportar un Staff"><?= $lang["ReportOption5"] ?></option>
          <option value="Sugerencias"><?= $lang["ReportOption6"] ?></option>
        </select>
      </div>
    </div>

    <div class="help-form-field">
      <label class="help-form-label" for="report_problem"><i class="fas fa-align-left mr-2"></i>Descripción detallada</label>
      <div class="help-input-wrapper">
        <textarea name="problem" id="report_problem" class="help-custom-textarea" placeholder="Explica detalladamente qué sucedió..." required></textarea>
      </div>
      <p class="help-field-desc">Incluye pasos para reproducir el error si es posible.</p>
    </div>

    <div class="help-form-footer">
        <button type="submit" name="report" class="help-submit-btn">
            <span>Enviar Reporte</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
        </button>
    </div>
  </form>
</div>
