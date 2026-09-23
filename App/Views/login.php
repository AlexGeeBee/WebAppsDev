<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="/App/public/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/App/public/css/style.css">
</head>
<body>
    <div class="wrapper d-flex flex-column align-items-center container">

        <form class="user_form mt-5 d-flex flex-column col-4 row-gap-3" action="/App/public/login" method="post">
            <div class="text-center form_text">
                <h1>Вход</h1>
                <p class="auth_error mt-2"><?= isset($_SESSION['error']) ? $_SESSION['error'] : "" ?></p>
            </div>

            <input class="form-control" type="text" name="login" id="login" placeholder="Логин">
            <input class="form-control" type="password" name="password" id="password" placeholder="Пароль">

            <input class="btn auth_button btn-primary" type="submit" value="Войти">
            <p class="text-center">Нет аккаунта? <a href="/App/public/register">Зарегистрироваться</a></p>
        </form>
    </div>
</body>
</html>