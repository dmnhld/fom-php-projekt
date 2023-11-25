<?php

namespace Model;

class Product extends Model{
    protected String $table = 'products';

    public function countInCategory($categoryId): int{
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE category = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_row()[0];
    }

    public function create($name, $price, $category, $description): bool{
        $price = (double) $price;

        $sql = "INSERT INTO {$this->table} (name, price, category, description) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sdis', $name, $price, $category, $description);
        $stmt->execute();
        return true;
    }

    public function filterByCategory($categoryId): array{
        $sql = "SELECT * FROM {$this->table} WHERE category = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}