<?php if (!empty($items) && isset($products) && isset($categories)): ?>
    <h1>Vielen Dank für Ihre Bestellung</h1>
    <p>Sie haben folgendes bestellt:</p>
    <table>
        <tr>
            <th>Produkt</th>
            <th>Kategorie</th>
            <th>Menge</th>
        </tr>
        <?php $totalPrice = 0; foreach ($items as $item): ?>
            <tr>
                <td><?= $products[$item['product']]['name'] ?></td>
                <td><?= $categories[$products[$item['product']]['category']] ?></td>
                <td><?= $item['amount'] ?></td>
            </tr>
            <?php $totalPrice += $products[$item['product']]['price'] * $item['amount']; ?>
        <?php endforeach; ?>
    </table>
    <p><b>Gesamtpreis:</b> <?= $totalPrice ?>€</p>
    <a href="?controller=shop&action=index">Zurück zur Startseite</a>
<?php else: ?>
    <p>Es gibt keine bestellten Artikel.</p>
<?php endif; ?>