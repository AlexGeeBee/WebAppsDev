<?php

namespace App\Controllers;

use App\Models\RequestModel;
use App\Models\StatusModel;

class AdminController {
    public function showAllRequests() {
        $requestModel = new RequestModel();
        $statusModel = new StatusModel();

        $requests = $requestModel->findAll();
        $statuses = $statusModel->all();

        require __DIR__ . '/../Views/admin_page.php';
    }

    public function changeRequestStatus() {
        $request_id = (int) ($_POST['request_id'] ?? 0);
        $status_id = (int) ($_POST['request_status_id'] ?? 0);

        if ($request_id <= 0 || $status_id <= 0) {
            $_SESSION['error'] = 'Некорректные данные для изменения статуса';
            header('Location: ' . BASE_URL . '/admin_page'); //
            exit;
        }

        $requestModel = new RequestModel();
        $statusModel = new StatusModel();

        if (!$requestModel->findById($request_id)) {
            $_SESSION['error'] = 'Заявка не найдена';
            header('Location: ' . BASE_URL . '/admin_page'); //
            exit;
        }

        if (!$statusModel->exists($status_id)) {
            $_SESSION['error'] = 'Выбранный статус не найден';
            header('Location: ' . BASE_URL . '/admin_page'); //
            exit;
        }

        $requestModel->updateStatus($request_id, $status_id);

        $_SESSION['success'] = 'Статус заявки успешно изменён';
        header('Location: ' . BASE_URL . '/admin_page'); //
        exit;
    }
}

?>