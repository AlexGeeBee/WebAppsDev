<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController {
    public function showRegisterForm() {
        require __DIR__ . '/../Views/register.php';
    }

    public function showLoginForm() {
        require __DIR__ . '/../Views/login.php';
    }

    public function register() {
        $login = trim($_POST['login']);
        $email = trim($_POST['email']);
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $patronymic = trim($_POST['patronymic']);
        $phone = trim($_POST['phone']);
        $password = trim($_POST['password']);

        // Проверка что все поля заполнены
        if ($login === '' || $email === '' || $name === '' || $surname === '' || $patronymic === '' || $phone === '' || $password === '') {
            $_SESSION['error'] = 'Не все поля заполнены';
            header('Location: /App/public/register');
            exit;
        }
        
        // Проверка на правильность почты
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Введена некорректная почта';
            header('Location: /App/public/register');
            exit;
        }

        // Проверка на длину логина
        if (mb_strlen($login) < 8) {
            $_SESSION['error'] = 'Логин должен быть длиннее 7 символов';
            header('Location: /App/public/register');
            exit;
        }

        // Проверка на длину пароля
        if (mb_strlen($password) < 8) {
            $_SESSION['error'] = 'Пароль должен быть длиннее 7 символов';
            header('Location: /App/public/register');
            exit;
        }


        $userModel = new UserModel();
        
        if ($userModel->findUserByEmail($email)) {
            $_SESSION['error'] = 'Почта уже занята';
            header('Location: /App/public/register');
            exit;
        }

        if ($userModel->findUserByLogin($login)) {
            $_SESSION['error'] = 'Логин уже занят';
            header('Location: /App/public/register');
            exit;
        }

        $userModel->create($login, $password, $surname, $name, $patronymic, $phone, $email);
        $_SESSION['success'] = 'Регистрация прошла успешно. Теперь войдите в аккаунт';
        header('Location: /App/public/login');
        exit;


    }

    public function login() {
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);

        if ($login === '') {
            $_SESSION['error'] = 'Поле логина пустое';
            header('Location: /App/public/login');
            exit;
        }

        if ($password === '') {
            $_SESSION['error'] = 'Поле пароля пустое';
            header('Location: /App/public/login');
            exit;
        }

        $userModel = new UserModel();
        $user = $userModel->findUserByLogin($login);

        if (!$user) {
            $_SESSION['error'] = 'Неверный логин';
            header('Location: /App/public/login');
            exit;
        }

        if (!password_verify($password, $user['password_hash'])) {
            $_SESSION['error'] = 'Неверный пароль';
            header('Location: /App/public/login');
            exit;
        }

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['success'] = 'Авторизация успешна';
        header('Location: /App/public/');
        exit;
    }

    public function logout() {

        $_SESSION['user_id'] = '';
        $_SESSION['login'] = '';
        $_SESSION['user_role'] = '';
        $_SESSION['success'] = '';

        header('Location: /App/public/login');
        exit;
    }
}


?>