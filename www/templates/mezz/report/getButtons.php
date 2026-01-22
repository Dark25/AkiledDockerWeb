<?php if ($news2["state"] == 'Abierto') { ?>

  <span class="report-status-inline status-open"><?php echo filter($news2["state"]); ?></span>

<?php } ?>

<?php if ($news2["state"] == 'Cerrado') { ?>

  <span class="report-status-inline status-closed"><?php echo filter($news2["state"]); ?></span>

<?php } ?>

<?php if ($news2["state"] == 'Tratamiento') { ?>

  <span class="report-status-inline status-progress"><?php echo filter($news2["state"]); ?></span>

<?php } ?>