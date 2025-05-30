<?php

namespace App\Core;

use Exception;

class BaseController {


    protected function doGet():BaseView {
        throw new Exception("Controller does not have a doGet");
    }
    protected function doPost():BaseView {
        throw new Exception("Controller does not have a doPost");
    }

    public function processRequest() {
        if($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->doGet()->render();
        } else {
            $this->doPost()->render();
        }
    }
}