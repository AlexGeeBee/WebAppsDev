<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>
    <link rel="stylesheet" href="/App/public/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/App/public/css/style.css">
</head>
<body>
    <div class="wrapper d-flex justify-content-center align-items-center wrapper_404">
        <div class="error_box text-center">
            <h1>Такой страницы нет</h1>
            <p>Возможно адрес был введен с ошибкой, страница быа удалена или маршрут ещё не добавлен в приложение.</p>
            <p class="fs-5">Запрошенный маршрут:  <?= $path ?></p>
        </div>
    </div>
</body>
</html>