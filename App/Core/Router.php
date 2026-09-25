<?php

namespace App\Core;

class Router {
    private array $routes = [];
    private string $baseUrl;

    public function __construct(string $baseUrl = '') {
        $this->baseUrl = $baseUrl;
    }
}

?>