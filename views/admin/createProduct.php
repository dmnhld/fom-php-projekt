<h3>Produkt erstellen</h3>
<form class="form-control" method="post" action="?controller=admin&action=getCreateProduct">
    <div>
        <label for="category">Kategorien</label><br>
        <select id="category" name="category" required>
            <?php if (isset($categories)): foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>">
                    <?= $category['name'] ?>
                </option>
            <?php endforeach; endif;?>
        </select>
    </div>
    <div>
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="price">Preis</label><br>
        <input type="number" step="0.01" name="price" id="price" placeholder="€" required>
    </div>
    <div>
        <label for="description">Beschreibung</label><br>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
    </div>
    <div>
        <button class="btn" type="submit">Erstellen</button>
    </div>
</form><?php
