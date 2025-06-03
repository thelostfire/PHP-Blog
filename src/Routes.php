<?php

namespace App;

use App\Controller\HomeController;
use App\Controller\PublicationController;
use App\Controller\PublicationFormController;
use App\Controller\UpdateFormController;

class Routes {

    public static function defineRoutes() {
        
        return [
            "/" => new HomeController(),
            "form" => new PublicationFormController(),
            "publication" => new PublicationController(),
            "update" => new UpdateFormController()
        ];
    }
}