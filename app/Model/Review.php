<?php

namespace Model;

class Review extends Model {
    protected String $table = 'reviews';

    public function filterByProduct($product): array{
        $sql = "SELECT * FROM {$this->table} WHERE product = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $product);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($product, $rating, $content, $user): bool{
        $rating = (int) $rating;

        $sql = "INSERT INTO {$this->table} (product, rating, content, user) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iisi', $product, $rating, $content, $user);
        $stmt->execute();
        return true;
    }
}