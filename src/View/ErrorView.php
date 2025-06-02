<?php

namespace App\View;

use App\Core\BaseView;

class ErrorView extends BaseView{

    public function __construct(private string $errorMsg) {}

    public function render(): void {
        echo "<h1>$this->errorMsg</h1>";
        http_response_code(404);
    }
}