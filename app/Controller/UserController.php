<?php
namespace Controller;

use Model\User;

class UserController extends Controller {
    private User $user;

    public function __construct() {
        $this->user = new User();
    }

    private function redirectIfLoggedIn(): void {
        if ($this->user->isLoggedIn()) {
            if ($this->user->isAdmin()){
                header('Location: ?controller=admin&action=index');
            } else {
                header('Location: ?controller=shop&action=index');
            }
        }
    }

    public function index(): void {
        $this->redirectIfLoggedIn();
        $this->view('user/login');
    }

    public function getLogin(): void {
        $this->redirectIfLoggedIn();

        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->user->findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            if ($this->user->isAdmin()){
                header('Location: ?controller=admin&action=index');
            } else {
                header('Location: ?controller=shop&action=index');
            }
        } else {
            $this->view('user/login', ['error' => 'Benutzername oder Passwort falsch']);
        }

    }

    public function register(): void {
        $this->redirectIfLoggedIn();
        $this->view('user/register');
    }

    public function getRegister(): void {
        $this->redirectIfLoggedIn();

        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordRp = $_POST['password_rp'];

        if (empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($passwordRp)) {
            $this->view('user/register', ['error' => 'Bitte alle Felder ausfüllen']);
            return;
        }

        if ($password !== $passwordRp) {
            $this->view('user/register', ['error' => 'Passwörter stimmen nicht überein']);
            return;
        }

        $user = $this->user->findByUsername($username);

        if ($user) {
            $this->view('user/register', ['error' => 'Benutzername bereits vergeben']);
        } else {
            $this->user->create($firstName, $lastName, $username, $password);
            $this->view('user/login', ['success' => 'Benutzer erfolgreich erstellt']);
        }
    }

    public function logout(): void {
        unset($_SESSION['user']);
        header('Location: ?controller=user&action=index');
    }
}