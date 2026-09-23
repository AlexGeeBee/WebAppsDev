<?php

use App\Models\ServiceModel;
use App\Models\PaymentMethodModel;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новая заявка</title>
    <link rel="stylesheet" href="/App/public/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/App/public/css/style.css">
</head>
<body>
    <div class="wrapper d-flex container justify-content-center">
        <form class="user_form d-flex flex-column row-gap-4 mt-5" action="/App/public/new_request" method="post">
                
            <h1>Новая заявка</h1>

            <p class="auth_error mt-2 text-center"><?= isset($_SESSION['error']) ? $_SESSION['error'] : "" ?></p>

            <select class="form-select" aria-label="Default select" name="service_id">
                <option selected>Выберите тип услуги</option>

                <?php
                $serviceModel = new ServiceModel();
                foreach ($serviceModel->all() as $service) {
                    $id = $service['service_id'];
                    $name = $service['name'];
                    $price = $service['price'];
                    echo "<option value=\"{$id}\">{$name} - {$price}р</option>";
                }
                ?>
            </select>


            <div class="d-flex flex-column">
                <label for="preferred_date" class="form-label">Выберите желаемую дату:</label>
                <input type="date" id="preferred_date" name="preferred_date" min="2026-09-19" max="2026-11-19"/>
            </div>

            <select class="form-select" aria-label="Default select" name="payment_method_id">
                <option selected>Выберите способ оплаты</option>

                <?php
                $paymentMethodModel = new PaymentMethodModel();
                foreach ($paymentMethodModel->all() as $payMethod) {
                    $id = $payMethod['payment_method_id'];
                    $name = $payMethod['name'];
                    echo "<option value=\"{$id}\">{$name}</option>";
                }
                ?>
            </select>

            <input type="submit" class="btn auth_button btn-primary" value="Записаться">
        </form>
    </div>
</body>
</html>