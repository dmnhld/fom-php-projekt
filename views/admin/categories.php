<?php if (!isset($categories)) $categories = [] ?>

<h3>Alle Kategorien <a style="font-size: 12px;" href="?controller=admin&action=createCategory">(Hier neu erstellen)</a></h3>
    <br>
<?php foreach ($categories as $category): ?>
    <div style="margin-top: 20px;">
        <div style="display: inline-block; width: 200px;"><?= $category['name'] ?> (Produkte: <?= $productsCount[$category['id']] ?? '0' ?>)</div>
        <div style="display: inline-block; width: 200px;"><a style="color: red;" href="?controller=admin&action=deleteCategory&id=<?= $category['id'] ?>">Löschen</a></div>
    </div>
    <hr>
<?php endforeach; ?>