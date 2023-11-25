<?php

class Router {
    public function route(): void {
        $controllerName = $_GET['controller'] ?? 'user';
        $action = $_GET['action'] ?? 'index';

        $controllerName = 'Controller\\' . ucfirst(strtolower($controllerName)) . 'Controller';
        $action = strtolower($action);

        if (class_exists($controllerName) && method_exists($controllerName, $action)) {
            $controller = new $controllerName();
            call_user_func_array([$controller, $action], []);

        } else {
            echo "404 Not Found <br> <a href='?controller=user'>Zurück zur Startseite</a>";
        }
    }
}
