<?php

namespace Model;

class Cart extends Model {
    protected String $table = 'carts';

    public function filterByUser($user): array{
        $sql = "SELECT * FROM {$this->table} WHERE user = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($user, $product, $amount): bool{
        $sql = "INSERT INTO {$this->table} (user, product, amount) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iii', $user, $product, $amount);
        return $stmt->execute();
    }

    public function updateAmount($item, $amount): bool{
        $sql = "UPDATE {$this->table} SET amount = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $amount, $item);
        return $stmt->execute();
    }
}