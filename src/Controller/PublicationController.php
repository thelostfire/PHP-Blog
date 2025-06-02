<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Core\BaseView;
use App\Repository\PublicationRepository;
use App\View\ErrorView;
use App\View\PublicationView;

class PublicationController extends BaseController{

    protected function doGet(): BaseView {

        $id = $_GET["id"];
        if(!empty($id) && is_numeric($id)) {

            $publiRepo = new PublicationRepository;
            $publication = $publiRepo -> findById($id);
            if($publication) {
                return new PublicationView($publication);
            }
        }
        return new ErrorView("ERROR: publication not found");
    }
}