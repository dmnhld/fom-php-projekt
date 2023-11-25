<?php if (isset($products) && isset($categories)): foreach ($products as $product): ?>
    <a href="?controller=shop&action=product&id=<?= $product['id'] ?>">
        <div style="margin-top: 20px;">
            <div style="display: inline-block; width: 200px;"><?= $product['name'] ?></div>
            <div style="display: inline-block; width: 200px;">Preis: <?= $product['price'] ?>€</div>
            <div style="display: inline-block; width: 200px;">Kategorie: <?= $categories[$product['category']] ?></div>
        </div>
    </a>
    <hr>
<?php endforeach; endif; ?>