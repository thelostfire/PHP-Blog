<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Core\BaseView;
use App\Entity\Publication;
use App\Repository\PublicationRepository;
use App\View\ErrorView;
use App\View\HomeView;
use App\View\PublicationFormView;

class PublicationFormController extends BaseController{

    public function doGet(): BaseView {
        return new PublicationFormView();
    }

    public function doPost(): BaseView {

        if(empty($_POST["formAuthor"]) || empty($_POST["formTitle"]) || empty($_POST["formContent"])) {
            return new ErrorView("Veuillez remplir tous les champs.");
        }
        $repo = new PublicationRepository;
        $newPublication = new Publication($_POST["formTitle"], $_POST["formContent"], date("Y-m-d H-i-s"), 0, $_POST["formAuthor"]);
        $repo->persist($newPublication);
        return new HomeView($repo->findAll());
    }
}