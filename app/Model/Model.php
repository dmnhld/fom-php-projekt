<?php

namespace Model;

use Database;

abstract class Model {
    protected ?Database $db;
    protected String $table;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function all(): array {
        $result = $this->db->query("SELECT * FROM {$this->table}");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id): false|array|null {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function delete($id): bool {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}