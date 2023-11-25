<h3>Willkommen <?= $_SESSION['user']['first_name'] ?>,</h3>
<div>
    Hier finden Sie alle Kategorien unserer Produkte.
</div>
<?php if (isset($categories)): foreach ($categories as $category): ?>
    <div style="margin-top: 20px;">
        <div style="display: inline-block; width: 200px;"><a href="?controller=shop&action=products&category=<?= $category['id'] ?>"><?= $category['name'] ?></a></div>
    </div>
    <hr>
<?php endforeach; endif; ?>