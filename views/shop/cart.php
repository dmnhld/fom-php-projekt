<?php if (!empty($items) && isset($products) && isset($categories)): ?>
    <table id="cart">
        <tr style="text-align: left;">
            <th>Produkt</th>
            <th>Kategorie</th>
            <th>Preis</th>
            <th>Menge</th>
            <th>Aktionen</th>
        </tr>
        <?php $totalPrice = 0; foreach ($items as $item): ?>
            <tr>
                <td><a href="?controller=shop&action=product&id=<?= $products[$item['product']]['id'] ?>"><?= $products[$item['product']]['name'] ?></a></td>
                <td><?= $categories[$products[$item['product']]['category']] ?></td>
                <td><?= $products[$item['product']]['price'] ?>€</td>
                <td>
                    <form action="?controller=shop&action=updateCart" method="post">
                        <input type="hidden" name="item" value="<?= $item['id'] ?>">
                        <input type="number" name="amount" min="1" value="<?= $item['amount'] ?>">
                        <button type="submit">Menge ändern</button>
                    </form>
                </td>
                <td>
                    <form action="?controller=shop&action=removeFromCart" method="post">
                        <input type="hidden" name="item" value="<?= $item['id'] ?>">
                        <button style="background: red" type="submit">Entfernen</button>
                    </form>
                </td>
            </tr>
            <?php $totalPrice += $products[$item['product']]['price'] * $item['amount']; ?>
        <?php endforeach; ?>
    </table>
    <p><b>Gesamtpreis:</b> <?= $totalPrice ?>€</p>
    <form action="?controller=shop&action=checkout" method="post">
        <button type="submit">Bestellung abschicken</button>
    </form>
<?php else: ?>
    <p>Der Warenkorb ist leer.</p>
<?php endif; ?>
