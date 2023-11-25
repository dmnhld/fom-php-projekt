<!DOCTYPE html>
<html lang="de">
<head>
    <title>Shop</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./../../css/app.css">
    <style>
        .navigation {
            background-color: #3da7e0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .navigation ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        .navigation ul li {
            margin: 0 20px;
        }

        .navigation ul li:first-child {
            font-weight: bold;
        }

        .nav-link {
            display: inline-block;
            text-decoration: none;
            color: white; /* Weiße Textfarbe */
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-link:hover, .nav-link:focus {
            background-color: #1E6091;
        }

        @media (max-width: 768px) {
            .navigation ul {
                flex-direction: column;
            }

            .navigation ul li {
                margin: 10px 0;
            }
        }

    </style>
</head>
<body>
<?php if (isset($_SESSION['user'])): ?>
    <nav class="navigation">
        <ul>
            <!-- Unterschiedliche Home-Links für Admin und normale Nutzer -->
            <?php if ($_SESSION['user']['is_admin']): ?>
                <li><a href="?controller=admin&action=index" class="nav-link">Admin-Home</a></li>
                <li><a href="?controller=admin&action=products" class="nav-link">Produkte</a></li>
                <li><a href="?controller=admin&action=categories" class="nav-link">Kategorien</a></li>
            <?php else: ?>
                <li><a href="?controller=shop&action=index" class="nav-link">Home</a></li>
                <li><a href="?controller=shop&action=products" class="nav-link">Alle Produkte</a></li>
                <li><a href="?controller=shop&action=cart" class="nav-link">Warenkorb</a></li>
            <?php endif; ?>
            <li><a href="?controller=user&action=logout" class="nav-link">Logout</a></li>
        </ul>
    </nav>
<?php endif; ?>

<div style="padding: 0 12px;">

<?php if (isset($error)): ?>
    <div style='color: red; margin: 5px; text-align: center'><?= $error ?></div>
<?php endif; ?>
<?php if (isset($success)): ?>
    <div style='color: green; margin: 5px; text-align: center'><?= $success ?></div>
<?php endif; ?>
