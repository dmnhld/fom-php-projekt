<?php

namespace Model;

class Category extends Model {
    protected String $table = 'categories';

    public function findByName($name): ?array{
        $sql = "SELECT * FROM {$this->table} WHERE name = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($name) : bool{
        $category = $this->findByName($name);
        if ($category) {
            return false;
        }else{
            $sql = "INSERT INTO {$this->table} (name) VALUES (?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('s', $name);
            $stmt->execute();
            return true;
        }

    }
}