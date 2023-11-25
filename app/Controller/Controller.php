<?php

namespace Controller;

class Controller {
    protected string $viewPath = __DIR__.'/../../views/';

    public function view($viewName, $data = []): void {
        $path = $this->viewPath . $viewName . '.php';
        if (file_exists($path)) {
            extract($data);
            include $this->viewPath.'layout/header.php';
            include($path);
            include $this->viewPath.'layout/footer.php';
        } else {
            die("Die View '$this->viewPath.{$viewName}' existiert nicht.");
        }
    }
}