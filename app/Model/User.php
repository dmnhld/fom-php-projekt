<?php

namespace Model;

class User extends Model {
    protected String $table = 'users';

    public function findByUsername(String $username): ?array {
        $sql = "SELECT * FROM {$this->table} WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function isLoggedIn(): bool {
        return isset($_SESSION['user']);
    }
    public function isAdmin(): bool {
        return $this->isLoggedIn() && $_SESSION['user']['is_admin'];
    }

    public function create($firstName, $lastName, $username, $password, $isAdmin = false): void{
        $hashedPas = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO {$this->table} (first_name, last_name, username, password, is_admin) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssssi', $firstName, $lastName, $username, $hashedPas, $isAdmin);
        $stmt->execute();
    }

}