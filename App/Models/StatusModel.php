<?php

namespace App\Models;

use App\Core\Database;

class StatusModel {
    public function all() {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT request_status_id, name FROM Request_status ORDER BY request_status_id');
        return $stmt->fetchAll();
    }

    public function exists(int $id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT 1 FROM Request_status WHERE request_status_id = :id LIMIT 1');
        $stmt->execute(['id' => $id,]);
        return (bool) $stmt->fetchColumn();
    }
}

?>