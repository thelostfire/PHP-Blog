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

    protected function upload(array $file): string {
    
            $uploadFolder=$_ENV["UPLOAD_FOLDER"];
            $filename=uniqid().".".pathinfo($file["name"])["extension"];
            if(!file_exists($uploadFolder)) {
                mkdir($uploadFolder);
            }
            move_uploaded_file($file["tmp_name"], "$uploadFolder/$filename");
            echo "$uploadFolder/$filename <br> Hahahahaha <br>";
            return $filename;   
    }
}