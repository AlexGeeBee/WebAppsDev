<?php

namespace App\Models;

use App\Core\Database;

class RequestModel {
    public function create(int $service_id, int $user_id, $preferred_date, int $payment_method_id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO Request (service_id, user_id, preferred_date, payment_method_id, status_id) VALUES (:service_id, :user_id, :preferred_date, :payment_method_id, :status_id)');

        return $stmt->execute([
            'service_id' => $service_id,
            'user_id' => $user_id,
            'preferred_date' => $preferred_date,
            'payment_method_id' => $payment_method_id,
            'status_id' => 1,
        ]);
    }

    public function findByUserId(int $user_id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare(
            'SELECT
                ROW_NUMBER() OVER (ORDER BY r.preferred_date) AS row_num,
                s.name AS service_type,
                s.price AS price,
                r.preferred_date,
                st.name AS status,
                pm.name AS payment_method
            FROM Request r
            JOIN Service s ON s.service_id = r.service_id
            JOIN Request_status st ON st.request_status_id = r.status_id
            JOIN Payment_method pm ON pm.payment_method_id = r.payment_method_id
            WHERE r.user_id = :user_id
            ORDER BY row_num');

        $stmt->execute(['user_id' => $user_id]);
        
        return $stmt->fetchAll();
    }

    public function findAll() {
        $pdo = Database::getConnection();
        $stmt = $pdo->query(
            'SELECT
                ROW_NUMBER() OVER (ORDER BY r.preferred_date) AS row_num,
                r.request_id,
                r.preferred_date,
                s.price,
                s.name AS service,
                rs.name AS status,
                u.user_id,
                u.login AS user_login,
                u.email AS user_email
            FROM Request r
            JOIN Service s on s.service_id = r.service_id
            JOIN Request_status rs on rs.request_status_id = r.status_id
            JOIN User u on u.user_id = r.user_id
            ');

        return $stmt->fetchAll();
    }

    public function findById(int $id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare(
            'SELECT
                r.request_id,
                r.preferred_date,
                s.price,
                s.name AS service,
                rs.name AS status,
                u.user_id,
                u.login AS user_login,
                u.email AS user_email
            FROM Request r
            JOIN Service s on s.service_id = r.service_id
            JOIN Request_status rs on rs.request_status_id = r.status_id
            JOIN User u on u.user_id = r.user_id
            WHERE r.request_id = :id
            LIMIT 1
            ');

        $stmt->execute(['id' => $id,]);
        return (bool) $stmt->fetchColumn();
    }

    public function updateStatus(int $request_id, int $status_id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare(
            'UPDATE Request
            SET status_id = :status_id
            WHERE request_id = :request_id'
            );

            return $stmt->execute(['status_id' => $status_id, 'request_id' => $request_id]);
    }
}





// ЗАПРОС:
// SELECT
//     r.request_id,
//     s.name AS service_type,
//     s.price AS price,
//     r.preferred_date,
//     st.name AS status,
//     pm.name AS payment_method
// FROM Request r
// JOIN Service s ON s.service_id = r.service_id
// JOIN Request_status st ON st.request_status_id = r.status_id
// JOIN Payment_method pm ON pm.payment_method_id = r.payment_method_id
// WHERE r.user_id = 5
// ORDER BY r.preferred_date DESC


// Запрос всех заявок:
// SELECT
// 	r.request_id,
//     r.preferred_date,
//     s.price,
//     s.name AS service,
//     rs.name AS status,
//     u.user_id,
//     u.login AS user_login,
//     u.email AS user_email
// FROM Request r
// JOIN Service s on s.service_id = r.service_id
// JOIN Request_status rs on rs.request_status_id = r.status_id
// JOIN User u on u.user_id = r.user_id
?>