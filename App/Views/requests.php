<?php

use App\Controllers\RequestController;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ваши заявки</title>
    <link rel="stylesheet" href="/App/public/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/App/public/css/style.css">
</head>
<body>
    <div class="wrapper d-flex flex-column align-items-center container">
        <div class="header d-flex justify-content-between align-items-center mt-5 col-9">
            <h1 class="mb-2">Ваши заявки</h1>
            <div class=""><a href="/App/public/new_request" class="btn btn-primary auth_button" role="button">Новая заявка</a></div>
        </div>

        <div class="requests_block d-flex flex-column mt-4 col-9">
            <div class="request requests_header d-flex justify-content-between">
                <div class="table_col_small">№</div>
                <div class="table_col_md">Услуга</div>
                <div class="table_col_small">Цена</div>
                <div class="table_col_md">Дата</div>
                <div class="table_col_md">Способ оплаты</div>
                <div class="table_col_md">Статус</div>
            </div>

            <?php
            $controller = new RequestController();

            foreach ($controller->index() as $request) {

            $num = $request['row_num'];
            $service = $request['service_type'];
            $price = $request['price'];
            $date = $request['preferred_date'];
            $payment = $request['payment_method'];
            $status = $request['status'];

                echo "<div class=\"request d-flex justify-content-between\">
                        <div class=\"table_col_small\">$num</div>
                        <div class=\"table_col_md\">$service</div>
                        <div class=\"table_col_small\">$price</div>
                        <div class=\"table_col_md\">$date</div>
                        <div class=\"table_col_md\">$payment</div>
                        <div class=\"table_col_md\">$status</div>
                    </div>";
            }
            ?>
        </div>
    </div>
</body>
</html>