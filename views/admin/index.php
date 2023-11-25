<h3>Willkommen <?= $_SESSION['user']['first_name'] ?>,</h3>
<div style="margin-top: 20px;">
    <ul>
        <li><a href="?controller=admin&action=products">Alle Produkte</a></li>
        <li><a href="?controller=admin&action=categories">Alle Kategorien</a></li>
        <li><a href="?controller=admin&action=createProduct">Produkt erstellen</a></li>
        <li><a href="?controller=admin&action=createCategory">Kategorie erstellen</a></li>
    </ul>
</div>