<?php if (isset($product) && isset($categories)): ?>
    <div>
        <h1><?= $product['name'] ?></h1>
        <form action="?controller=shop&action=addCart" method="post" style="margin: 30px 0;">
            <input type="hidden" name="product" value="<?= $product['id'] ?>">
            <input type="number" id="amount" name="amount" min="1" value="1">
            <label for="amount">Stk.</label>
            <button type="submit">In den Warenkorb</button>
        </form>
        <p><b>Preis:</b> <?= $product['price'] ?>€</p>
        <p><b>Kategorie:</b> <?= $categories[$product['category']] ?></p>
        <p style="white-space: pre-wrap;"><b>Beschreibung:</b>
            <br><?= $product['description'] ?>
        </p>
        <hr>
    </div>
    <h4>Bewertung abgeben</h4>
    <form action="?controller=shop&action=addReview" method="post">
        <input type="hidden" name="product" value="<?= $product['id'] ?>">
        <div>
            <label for="rating">Bewertung:</label>
            <br>
            <select name="rating" id="rating">
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div>
            <label for="content">Inhalt:</label>
        </div>
        <div>
            <textarea name="content" id="content" cols="25" rows="4"></textarea>
        </div>
        <div>
            <button type="submit">Absenden</button>
        </div>
    </form>
    <br>
    <hr>
    <?php if (isset($reviews)): ?>
        <h2>Bewertungen</h2>
        <?php foreach ($reviews as $review): ?>
            <div style="margin-bottom: 30px; border-left: 3px solid black; padding-left: 5px;">
                <p style="font-size: 15px; font-weight: bold">
                    <?= $users[$review['user']]['first_name'] ?? 'Unbekannt' ?>
                </p>
                <p>
                    <?php for ($i = 1; $i <= $review['rating']; $i++): ?>
                        <span style="color: gold;">★</span>
                    <?php endfor; ?>
                </p>
                <p><?= $review['content'] ?></p>
            </div>
        <?php endforeach; endif; ?>
<?php endif; ?>