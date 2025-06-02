<?php

namespace App;

use App\Controller\HomeController;
use App\Controller\PublicationController;
use App\Controller\PublicationFormController;

class Routes {

    public static function defineRoutes() {
        
        return [
            "/" => new HomeController(),
            "form" => new PublicationFormController(),
            "publication" => new PublicationController()
        ];
    }
}