<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="/App/public/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/App/public/css/style.css">
</head>
<body>
    <div class="wrapper d-flex flex-column align-items-center container">
        <h1 class="align-self-start mt-5">Все заявки</h1>

        <div class="requests_block d-flex flex-column mt-4 col-11">
            <div class="request requests_header d-flex justify-content-between">
                <div class="table_col_small">№</div>
                <div class="table_col_md">Пользователь</div>
                <div class="table_col_md">Услуга</div>
                <div class="table_col_md">Цена</div>
                <div class="table_col_md">Дата</div>
                <div class="table_col_md">Статус</div>
                <div class="table_col_big">Изменить</div>
            </div>

            <?php
            $status_options = '';

            foreach ($statuses as $status) {
                $id = $status['request_status_id'];
                $name = $status['name'];
                $status_options .= "<option value=\"{$id}\">{$name}</option>";
            }

            foreach($requests as $request) {
                $request_id = $request['request_id'];
                $num = $request['row_num'];
                $userLogin = $request['user_login'];
                $service = $request['service'];
                $price = $request['price'];
                $date = $request['preferred_date'];
                $status = $request['status'];

                echo "<div class=\"request d-flex justify-content-between align-items-center\">
                        <div class=\"table_col_small\">$num</div>
                        <div class=\"table_col_md\">$userLogin</div>
                        <div class=\"table_col_md\">$service</div>
                        <div class=\"table_col_md\">$price</div>
                        <div class=\"table_col_md\">$date</div>
                        <div class=\"table_col_md\">$status</div>
                        <div class=\"table_col_big\">
                            <form class=\"d-flex column-gap-3\" action=\"/App/public/request_update_status\" method=\"post\">
                                <select name=\"request_status_id\" class=\"form-select\" aria-label=\"Default select\">
                                    $status_options
                                </select>
                                
                                <input type=\"hidden\" name=\"request_id\" value=\"$request_id\">

                                <input type=\"submit\" class=\"btn auth_button btn-primary\" value=\"Изменить\">
                            </form>
                        </div>
                </div>";
            }

        ?>
        </div>
    </div>
</body>
</html>