<?php
session_start();

// Core Funktionen
require_once 'Router.php';
require_once 'app/Database.php';

// Controller
require_once 'app/Controller/Controller.php';
require_once 'app/Controller/UserController.php';
require_once 'app/Controller/ShopController.php';
require_once 'app/Controller/AdminController.php';

// Models
require_once 'app/Model/Model.php';
require_once 'app/Model/User.php';
require_once 'app/Model/Category.php';
require_once 'app/Model/Product.php';
require_once 'app/Model/Review.php';
require_once 'app/Model/Cart.php';

$router = new Router();
$router->route();
