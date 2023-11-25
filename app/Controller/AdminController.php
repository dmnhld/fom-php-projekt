<?php

namespace Controller;

use Model\Category;
use Model\Product;
use Model\User;

class AdminController extends Controller {
    private User $user;
    private Category $categories;
    private Product $products;

    public function __construct() {
        $this->user = new User();
        $this->categories = new Category();
        $this->products = new Product();

        if (!$this->user->isAdmin()) {
            header('Location: ?controller=user&action=index');
        }
    }

    public function index(): void {
        $this->view('admin/index');
    }

    public function createCategory(): void {
        $this->view('admin/createCategory');
    }

    public function getCreateCategory(): void {
        $name = $_POST['name'];
        if (empty($name)) {
            header('Location: ?controller=admin&action=createCategory');
            return;
        }
        if ($this->categories->create($name)) {
            $this->view('admin/createCategory', ['success' => "Kategorie {$name} wurde erstellt."]);
        } else {
            $this->view('admin/createCategory', ['error' => "Kategorie {$name} konnte nicht erstellt werden."]);
        }
    }

    public function categories($error = ''): void {
        $categories = $this->categories->all();
        $productsCount = [];

        foreach ($categories as $category) {
            $productsCount[$category['id']] = $this->products->countInCategory($category['id']);
        }
        $this->view('admin/categories', ['categories' => $categories, 'productsCount' => $productsCount, 'error' => $error]);
    }

    public function deleteCategory(): void {
        $id = $_GET['id'];
        if (empty($id)) {
            $this->categories("Kategorie konnte nicht gelöscht werden.");
            return;
        }

        if ($this->products->countInCategory($id) > 0) {
            $this->categories("Kategorie kann nicht gelöscht werden, da sie noch Produkte enthält.");
            return;
        }

        $this->categories->delete($id);

        header('Location: ?controller=admin&action=categories');
    }

    public function createProduct(): void {
        $this->view('admin/createProduct', ['categories' => $this->categories->all()]);
    }

    public function products($error = ''): void {
        $categories = $this->categories->all();
        $selectedCategory = $_POST['category'] ?? null;

        if ($selectedCategory) {
            $products = $this->products->filterByCategory($selectedCategory);
        } else {
            $products = $this->products->all();
        }

        $categories = array_column($this->categories->all(), 'name', 'id');

        $this->view('admin/products', ['products' => $products, 'categories' => $categories]);
    }

    public function getCreateProduct(): void {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        if (empty($name) || empty($price) || empty($category)) {
            header('Location: ?controller=admin&action=createProduct');
            return;
        }
        if ($this->products->create($name, $price, $category, $description)) {
            $this->view('admin/createProduct', ['success' => "Produkt {$name} wurde erstellt.", 'categories' => $this->categories->all()]);
        } else {
            $this->view('admin/createProduct', ['error' => "Produkt {$name} konnte nicht erstellt werden.", 'categories' => $this->categories->all()]);
        }
    }

    public function deleteProduct(): void {
        $id = $_GET['id'];
        if (empty($id)) {
            $this->products("Produkt konnte nicht gelöscht werden.");
            return;
        }

        $this->products->delete($id);

        header('Location: ?controller=admin&action=products');
    }
}