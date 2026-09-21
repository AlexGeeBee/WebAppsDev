<?php

namespace App\Models;

use App\Core\Database;

class UserModel {

    public function create(string $login, string $password, string $surname, string $name, string $patronymic, string $phone, string $email) {
        $pdo = Database::getConnection();
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO User (login, password_hash, surname, name, patronymic, phone_number, email) VALUES (?, ?, ?, ?, ?, ?, ?)");

        return $stmt->execute([$login, $passwordHash, $surname, $name, $patronymic, $phone, $email]);
    }

    public function findUserById(int $id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM User WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id,]);

        return $stmt->fetch();
    }

    public function findUserByEmail(string $email) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM User WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email,]);

        return $stmt->fetch();
    }

    public function findUserByLogin(string $login) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM User WHERE login = :login LIMIT 1");
        $stmt->execute(['login' => $login,]);

        return $stmt->fetch();
    }


}

?>