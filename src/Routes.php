<?php

namespace App;

use App\Controller\HomeController;

class Routes {

    public static function defineRoutes() {
        
        return [
            "/" => new HomeController()
        ];
    }
}