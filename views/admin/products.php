<?php
    $selectedCategory = $_POST['category'] ?? null;
?>

<h3>Alle Produkte <a style="font-size: 12px;" href="?controller=admin&action=createProduct">(Hier neu erstellen)</a></h3>
<form class="form-control" method="post" action="?controller=admin&action=products">
    <div>
        <label for="category">Kategorien</label><br>
        <select id="category" name="category">
            <option value="">Alle</option>
            <?php if (isset($categories)): foreach ($categories as $id => $category): ?>
                <option value="<?= $id ?>" <?= $id == $selectedCategory ? 'selected' : '' ?>>
                    <?= $category ?>
                </option>
            <?php endforeach; endif;?>
        </select>
    </div>
    <div>
        <button class="btn" type="submit">Filtern</button>
    </div>
</form>
<br>
<?php if (isset($products) && isset($categories)): foreach ($products as $product): ?>
    <div style="margin-top: 20px;">
        <div style="display: inline-block; width: 200px;">Name: <?= $product['name'] ?></div>
        <div style="display: inline-block; width: 200px;">Preis: <?= $product['price'] ?>€</div>
        <div style="display: inline-block; width: 200px;">Kategorie: <?= $categories[$product['category']] ?></div>
        <div style="display: inline-block; width: 200px;"><a style="color: red;" href="?controller=admin&action=deleteProduct&id=<?= $product['id'] ?>">Löschen</a></div>
    </div>
    <hr>
<?php endforeach; endif; ?>