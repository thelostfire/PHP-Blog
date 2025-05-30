<?php

namespace App\View;

class ErrorView {

    public function __construct(private string $errorMsg) {}

    public function render(): void {
        echo "<h1>404 Error</h1>";
        http_response_code(404);
    }
}