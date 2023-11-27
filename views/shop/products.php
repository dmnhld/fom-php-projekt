<?php
$selectedCategory = $_POST['category'] ?? $_GET['category'] ?? null;

if(isset($categories)): ?>
<form class="form-control" method="post" action="?controller=shop&action=products">
    <div>
        <label for="category">Kategorien</label><br>
        <select id="category" name="category">
            <option value="">Alle</option>
            <?php foreach ($categories as $id => $category): ?>
                <option value="<?= $id ?>" <?= $id == $selectedCategory ? 'selected' : '' ?>>
                    <?= $category ?>
                </option>
            <?php endforeach;?>
        </select>
    </div>
    <div>
        <button class="btn" type="submit">Filtern</button>
    </div>
</form>
<?php if (isset($products)): foreach ($products as $product): ?>
    <a href="?controller=shop&action=product&id=<?= $product['id'] ?>">
        <div style="margin-top: 20px;">
            <div style="display: inline-block; width: 200px;"><?= $product['name'] ?></div>
            <div style="display: inline-block; width: 200px;">Preis: <?= $product['price'] ?>€</div>
            <div style="display: inline-block; width: 200px;">Kategorie: <?= $categories[$product['category']] ?></div>
        </div>
    </a>
    <hr>
<?php endforeach; endif; endif; ?>