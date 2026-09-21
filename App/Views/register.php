<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/App/public/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/App/public/css/style.css">
</head>
<body>
    <div class="wrapper d-flex flex-column align-items-center container">

        <form class="mt-5 d-flex flex-column col-4 row-gap-3" action="/App/public/register" method="post">
            <div class="text-center form_text">
                <h1>Регистрация</h1>
                <p>Заполните все поля.</p>
                <p class="auth_error mt-2"><?= isset($_SESSION['error']) ? $_SESSION['error'] : "" ?></p>
            </div>

            <input class="form-control" type="text" name="login" id="login" placeholder="Логин">
            <input class="form-control" type="email" name="email" id="email" placeholder="Email">
            <input class="form-control" type="text" name="name" id="name" placeholder="Имя">
            <input class="form-control" type="text" name="surname" id="surname" placeholder="Фамилия">
            <input class="form-control" type="text" name="patronymic" id="patronymic" placeholder="Отчество">
            <input class="form-control" type="tel" name="phone" id="phone" placeholder="Телефон">
            <input class="form-control" type="password" name="password" id="password" placeholder="Пароль">

            <input class="btn auth_button btn-primary" type="submit" value="Зарегистрироваться">
            <p class="text-center">Уже есть аккаунт? <a href="/App/public/login">Войти</a></p>
        </form>
    </div>
</body>
</html>