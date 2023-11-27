<?php

namespace Controller;

use Model\Cart;
use Model\Category;
use Model\Product;
use Model\Review;
use Model\User;

class ShopController extends Controller {
    private User $user;
    private Category $categories;
    private Product $products;
    private Review $reviews;
    private Cart $cart;

    public function __construct() {
        $this->user = new User();
        $this->categories = new Category();
        $this->products = new Product();
        $this->reviews = new Review();
        $this->cart = new Cart();

        if (!$this->user->isLoggedIn()) {
            header('Location: ?controller=user&action=index');
        }
    }

    public function index(): void {
        $this->view('shop/index', ['categories' => $this->categories->all()]);
    }

    public function products(): void {
        $category = $_GET['category'] ?? $_POST['category'] ?? null;

        if ($category) {
            $products = $this->products->filterByCategory($category);
        } else {
            $products = $this->products->all();
        }

        $categories = array_column($this->categories->all(), 'name', 'id');

        $this->view('shop/products', ['products' => $products, 'categories' => $categories]);
    }

    public function product(): void {
        $id = $_GET['id'] ?? null;
        $product = null;

        if ($id) {
            $product = $this->products->find($id);
            if (!$product) {
                header('Location: ?controller=shop&action=products');
            }
        }

        $reviews = $this->reviews->filterByProduct($id);
        $users = array_column($this->user->all(), null, 'id');
        $categories = array_column($this->categories->all(), 'name', 'id');

        $this->view('shop/product', ['product' => $product, 'categories' => $categories, 'reviews' => $reviews, 'users' => $users]);
    }

    public function addReview(): void {
        $product = $_POST['product'];
        $rating = $_POST['rating'];
        $content = $_POST['content'];
        $user = $_SESSION['user']['id'];

        if (empty($product) || empty($rating) || empty($user) || $rating < 1 || $rating > 5) {
            header('Location: ?controller=shop&action=product&id=' . $product);
            return;
        }

        $this->reviews->create($product, $rating, $content, $user);
        header('Location: ?controller=shop&action=product&id=' . $product);
    }

    public function addCart(): void {
        $product = $_POST['product'];
        $amount = $_POST['amount'];
        $user = $_SESSION['user']['id'];

        if (empty($product) || empty($amount) || $amount < 1) {
            header('Location: ?controller=shop&action=product&id=' . $product);
            return;
        }

        $this->cart->create($user, $product, $amount);
        header('Location: ?controller=shop&action=cart');
    }

    public function cart(): void {
        $user = $_SESSION['user']['id'];
        $items = $this->cart->filterByUser($user);
        $products = array_column($this->products->all(), null, 'id');
        $categories = array_column($this->categories->all(), 'name', 'id');

        $this->view('shop/cart', ['items' => $items, 'products' => $products, 'categories' => $categories]);
    }

    public function removeFromCart(): void {
        $item = $_POST['item'];

        if (empty($item)) {
            header('Location: ?controller=shop&action=cart');
            return;
        }

        $checkItem = $this->cart->find($item);
        if (!$checkItem || $checkItem['user'] !== $_SESSION['user']['id']) {
            header('Location: ?controller=shop&action=cart');
            return;
        }

        $this->cart->delete($item);
        header('Location: ?controller=shop&action=cart');
    }

    public function updateCart(): void {
        $item = $_POST['item'];
        $amount = $_POST['amount'];

        if (empty($item) || empty($amount) || $amount < 1) {
            header('Location: ?controller=shop&action=cart');
            return;
        }

        $checkItem = $this->cart->find($item);
        if (!$checkItem || $checkItem['user'] !== $_SESSION['user']['id']) {
            header('Location: ?controller=shop&action=cart');
            return;
        }

        $this->cart->updateAmount($item, $amount);
        header('Location: ?controller=shop&action=cart');
    }

    public function checkout(): void {
        $user = $_SESSION['user']['id'];
        $items = $this->cart->filterByUser($user);
        $products = array_column($this->products->all(), null, 'id');
        $categories = array_column($this->categories->all(), 'name', 'id');

        foreach ($items as $item) {
            $this->cart->delete($item['id']);
        }

        $this->view('shop/checkout', ['items' => $items, 'products' => $products, 'categories' => $categories]);
    }
}

