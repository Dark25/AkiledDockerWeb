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

<style>
    .report-section-title {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        color: #888;
        margin: 20px 0 10px 0;
        display: block;
    }
    .report-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .report-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        text-decoration: none;
        color: #374151;
        transition: all 0.2s ease;
    }
    .report-item:hover {
        background-color: #f3f4f6;
        transform: translateX(3px);
    }
    .report-item.active {
        border-color: #eeb425;
        background-color: #fffbeb;
    }
    .report-item-title {
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }
    .report-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
        color: white;
        text-transform: uppercase;
    }
    .status-open { background-color: #10b981; }
    .status-progress { background-color: #f59e0b; }
    .status-closed { background-color: #6b7280; }
    .report-empty {
        font-size: 12px;
        color: #9ca3af;
        font-style: italic;
    }

    @media (prefers-color-scheme: dark) {
        .report-item {
            background-color: #1f2937;
            border-color: #374151;
            color: #d1d5db;
        }
        .report-item:hover {
            background-color: #374151;
        }
        .report-item.active {
            background-color: #1e1b1e;
            border-color: #eeb425;
        }
        .report-section-title {
            color: #6b7280;
        }
    }
</style>
