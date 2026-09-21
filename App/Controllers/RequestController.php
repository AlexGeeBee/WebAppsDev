<?php

namespace App\Controllers;

use App\Models\RequestModel;
use App\Models\ServiceModel;

class RequestController {
    public function index() {
        $requestModel = new RequestModel();
        $requests = $requestModel->findByUserId((int) $_SESSION['user_id']);
        
        return $requests; //
        // require __DIR__ . '/../Views/requests.php';
    }

    public function createForm() {
        $services = (new ServiceModel())->all();

        require __DIR__ . '/../Views/new_request.php';
    }

    public function store() {
        $service_id = (int) ($_POST['service_id'] ?? 0);
        $date = $_POST['preferred_date'];
        $payment_method_id = $_POST['payment_method_id'];

        if ($service_id <= 0) {
            $_SESSION['error'] = 'Выберите тип работы';
            header('Location: ' . BASE_URL . '/new_request'); //
            exit;
        }

        if (!(new ServiceModel())->exists($service_id)) {
            $_SESSION['error'] = 'Выбранная услуга не найдена';
            header('Location: ' . BASE_URL . '/new_request'); //
            exit;
        }
        
        if (!ctype_digit($payment_method_id)) {
            $_SESSION['error'] = 'Выберите способ оплаты';
            header('Location: ' . BASE_URL . '/new_request'); //
            exit;
        }

        $requestModel = new RequestModel();
        $requestModel->create($service_id, (int) $_SESSION['user_id'], $date, $payment_method_id);
        $_SESSION['success'] = 'Заявка успешно отправлена';

        header('Location: ' . BASE_URL . '/requests'); //
        exit;
    }

    
}




?>