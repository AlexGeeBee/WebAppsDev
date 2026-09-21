<?php

namespace App\Models;

use App\Core\Database;

class ServiceModel {
    public function all(): array {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT service_id, name, price FROM Service ORDER BY name');

        return $stmt->fetchAll();
    }

    public function exists(int $id): bool {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT 1 FROM Service WHERE service_id = :id LIMIT 1');
        $stmt->execute(['id' => $id,]);

        return (bool) $stmt->fetchColumn();
    }
}



?>