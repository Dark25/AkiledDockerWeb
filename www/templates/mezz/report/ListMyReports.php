<div class="report-history-container">

    <div class="report-section">
        <h4 class="report-status-group-title"><?= $lang["ReportListOpen"] ?></h4>
        <div class="report-items-list">
            <?php
            $getArticles = $dbh->prepare("SELECT * FROM cms_reports WHERE state = 'Abierto' AND author = :author ORDER BY id DESC");
            $getArticles->bindValue(':author', User::userData('username'));
            $getArticles->execute();
            $foundOpen = false;
            while ($a = $getArticles->fetch()) {
                $foundOpen = true;
                $activeClass = (isset($_GET['id']) && $_GET['id'] == $a['id']) ? 'is-active' : '';
                ?>
                <a href="/myreports/<?= filter($a['id']) ?>" class="report-row <?= $activeClass ?>">
                    <div class="report-row-content">
                        <span class="report-row-title"><i class="far fa-file-alt mr-2"></i><?= filter($a['title']) ?></span>
                        <span class="report-status-badge status-open">Abierto</span>
                    </div>
                </a>
                <?php
            }
            if (!$foundOpen) echo '<div class="report-empty-state">No tienes informes abiertos</div>';
            ?>
        </div>
    </div>

    <div class="report-section">
        <h4 class="report-status-group-title"><?= $lang["ReportListTratamiento"] ?></h4>
        <div class="report-items-list">
            <?php
            $getArticles = $dbh->prepare("SELECT * FROM cms_reports WHERE state = 'Tratamiento' AND author = :author ORDER BY id DESC");
            $getArticles->bindValue(':author', User::userData('username'));
            $getArticles->execute();
            $foundTrat = false;
            while ($a = $getArticles->fetch()) {
                $foundTrat = true;
                $activeClass = (isset($_GET['id']) && $_GET['id'] == $a['id']) ? 'is-active' : '';
                ?>
                <a href="/myreports/<?= filter($a['id']) ?>" class="report-row <?= $activeClass ?>">
                    <div class="report-row-content">
                        <span class="report-row-title"><i class="far fa-file-alt mr-2"></i><?= filter($a['title']) ?></span>
                        <span class="report-status-badge status-progress">En curso</span>
                    </div>
                </a>
                <?php
            }
            if (!$foundTrat) echo '<div class="report-empty-state">No hay informes en tratamiento</div>';
            ?>
        </div>
    </div>

    <div class="report-section">
        <h4 class="report-status-group-title"><?= $lang["ReportListClose"] ?></h4>
        <div class="report-items-list">
            <?php
            $getArticles = $dbh->prepare("SELECT * FROM cms_reports WHERE state = 'Cerrado' AND author = :author ORDER BY id DESC");
            $getArticles->bindValue(':author', User::userData('username'));
            $getArticles->execute();
            $foundClosed = false;
            while ($a = $getArticles->fetch()) {
                $foundClosed = true;
                $activeClass = (isset($_GET['id']) && $_GET['id'] == $a['id']) ? 'is-active' : '';
                ?>
                <a href="/myreports/<?= filter($a['id']) ?>" class="report-row <?= $activeClass ?>">
                    <div class="report-row-content">
                        <span class="report-row-title"><i class="far fa-file-alt mr-2"></i><?= filter($a['title']) ?></span>
                        <span class="report-status-badge status-closed">Cerrado</span>
                    </div>
                </a>
                <?php
            }
            if (!$foundClosed) echo '<div class="report-empty-state">No tienes informes cerrados</div>';
            ?>
        </div>
    </div>

</div>
