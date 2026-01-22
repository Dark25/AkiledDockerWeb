<div class="report-history">

    <h3 class="report-section-title"><?= $lang["ReportListOpen"] ?></h3>
    <div class="report-list">
        <?php
        $getArticles = $dbh->prepare("SELECT * FROM cms_reports WHERE state = 'Abierto' ORDER BY id DESC");
        $getArticles->execute();
        $foundOpen = false;
        while ($a = $getArticles->fetch()) {
            if (User::userData('username') == $a['author']) {
                $foundOpen = true;
                $activeClass = (isset($_GET['id']) && $_GET['id'] == $a['id']) ? 'active' : '';
                ?>
                <a href="/myreports/<?= filter($a['id']) ?>" class="report-item <?= $activeClass ?>">
                    <span class="report-item-title"><?= filter($a['title']) ?></span>
                    <span class="report-badge status-open">Abierto</span>
                </a>
                <?php
            }
        }
        if (!$foundOpen) echo '<p class="report-empty">No tienes informes abiertos.</p>';
        ?>
    </div>

    <h3 class="report-section-title"><?= $lang["ReportListTratamiento"] ?></h3>
    <div class="report-list">
        <?php
        $getArticles = $dbh->prepare("SELECT * FROM cms_reports WHERE state = 'Tratamiento' ORDER BY id DESC");
        $getArticles->execute();
        $foundTrat = false;
        while ($a = $getArticles->fetch()) {
            if (User::userData('username') == $a['author']) {
                $foundTrat = true;
                $activeClass = (isset($_GET['id']) && $_GET['id'] == $a['id']) ? 'active' : '';
                ?>
                <a href="/myreports/<?= filter($a['id']) ?>" class="report-item <?= $activeClass ?>">
                    <span class="report-item-title"><?= filter($a['title']) ?></span>
                    <span class="report-badge status-progress">En curso</span>
                </a>
                <?php
            }
        }
        if (!$foundTrat) echo '<p class="report-empty">No hay informes en tratamiento.</p>';
        ?>
    </div>

    <h3 class="report-section-title"><?= $lang["ReportListClose"] ?></h3>
    <div class="report-list">
        <?php
        $getArticles = $dbh->prepare("SELECT * FROM cms_reports WHERE state = 'Cerrado' ORDER BY id DESC");
        $getArticles->execute();
        $foundClosed = false;
        while ($a = $getArticles->fetch()) {
            if (User::userData('username') == $a['author']) {
                $foundClosed = true;
                $activeClass = (isset($_GET['id']) && $_GET['id'] == $a['id']) ? 'active' : '';
                ?>
                <a href="/myreports/<?= filter($a['id']) ?>" class="report-item <?= $activeClass ?>">
                    <span class="report-item-title"><?= filter($a['title']) ?></span>
                    <span class="report-badge status-closed">Cerrado</span>
                </a>
                <?php
            }
        }
        if (!$foundClosed) echo '<p class="report-empty">No tienes informes cerrados.</p>';
        ?>
    </div>

</div>
