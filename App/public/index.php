<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;
use App\Controllers\AuthController;
use App\Controllers\RequestController;

const BASE_URL = '/App/public';
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (str_starts_with($path, BASE_URL)) {
    $path = substr($path, strlen(BASE_URL));
}
if ($path === '') {
    $path = '/';
}

$method = $_SERVER['REQUEST_METHOD'];

function requireAuth() {
    if (empty($_SESSION['user_id'])) {
        $_SESSION['error'] = 'Сначала войдите в систему';
        header('Location: /App/public/login');
        exit;
    }
}

function redirectIfAuth() {
    if (!empty($_SESSION['user_id'])) {
        header('Location: /App/public/');
        exit;
    }
}

switch($path) {
    case '/':
        echo "Главная";
        break;

    case '/login':
        $controller = new AuthController();

        if ($method == "POST") {
            $controller->login();
        }

        else {
            $controller->showLoginForm();
        }
        $_SESSION['error'] = '';
        break;

    case '/register':
        $controller = new AuthController();

        if ($method == "POST") {
            $controller->register();
        }

        else {
            $controller->showRegisterForm();
        }
        $_SESSION['error'] = '';
        break;

    case '/logout':
        requireAuth();
        
        $controller = new AuthController();
        $controller->logout();

        break;

    case '/requests':

        requireAuth();
        
        require __DIR__ . '/../Views/requests.php';

        break;

    case '/new_request':
        requireAuth();
        $controller = new RequestController();

        if ($method == "POST") {
            $controller->store();
        }
        else {
            require __DIR__ . '/../Views/new_request.php';
        }
        

        $_SESSION['error'] = '';
        break;
    
    case '/admin_panel':

        if ($_SESSION['user_role'] == 'admin') {
            require __DIR__ . '/../Views/admin_panel.php';
        }
        else {
            header('Location: /App/public/');
            exit;
        }

        break;

    default:
        http_response_code(404);
        require __DIR__ . '/../Views/404.php';

}

?>