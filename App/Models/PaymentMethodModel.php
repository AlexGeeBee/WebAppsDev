<?php

namespace App\Models;

use App\Core\Database;

class PaymentMethodModel {
    public function all(): array {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT payment_method_id, name FROM Payment_method ORDER BY name');

        return $stmt->fetchAll();
    }

    public function exists(int $id): bool {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT 1 FROM Payment_method WHERE payment_method_id = :id LIMIT 1');
        $stmt->execute(['id' => $id,]);

        return (bool) $stmt->fetchColumn();
    }
}



?>