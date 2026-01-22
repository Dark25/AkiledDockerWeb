<div class="shop-grid">
    <?php
    $sql = $dbh->prepare("SELECT * FROM mezz_shop ORDER BY id ASC");
    $sql->execute();
    while ($item = $sql->fetch()) {
    ?>
        <div class="shop-item-card">
            <div class="shop-item-image-wrapper">
                <div class="shop-item-price-tag"><?php echo filter($item["price"]); ?>$</div>
                <img src="<?php echo filter($item["image"]); ?>" class="shop-item-image pixelated" alt="Shop Item">
            </div>

            <div class="shop-item-content">
                <div class="shop-item-reward-list">
                    <div class="shop-item-reward">
                        <img src="/assets/images/shop/esmeralda.png" alt="Esmeralda" class="pixelated">
                        <span class="shop-item-reward-text"><?php echo filter($item["esmeraldas"]); ?> Esmeraldas</span>
                    </div>
                    <div class="shop-item-reward">
                        <img src="/assets/images/user-space/planeta.png" alt="Planeta" class="pixelated">
                        <span class="shop-item-reward-text"><?php echo filter($item["planetas"]); ?> Planetas</span>
                    </div>
                </div>

                <a href="/articleshop/<?php echo filter($item["id"]); ?>" class="shop-item-buy-btn">Comprar ahora</a>
            </div>
        </div>
    <?php } ?>
</div>
