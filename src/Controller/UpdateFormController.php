<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Core\BaseView;
use App\Entity\Publication;
use App\Repository\PublicationRepository;
use App\View\ErrorView;
use App\View\PublicationFormView;
use App\View\PublicationView;
use App\View\RedirectView;

class UpdateFormController extends BaseController{


    protected function doGet(): BaseView {

        $id = $_GET["id"];
        if(!empty($id) && is_numeric($id)) {
            $repo = new PublicationRepository;
            $publication = $repo->findById($id);
            if($publication) {
                return new PublicationFormView($publication);
            }
        }
        return new PublicationFormView();
    }
    /**
     * Méthode qui s'occupe d'update la Publication lorsqu'on submit le formulaire.
     * $oldPublication donne une instance de la publication pré-modification, car on a besoin de paramètres 
     * qui ne sont pas concernés par le formulaire, comme les likes ou la date de publication initiale 
     * (qui ne change pas avec la modification)
     * @return ErrorView|PublicationView Renvoie sur la page de la publication modifiée.
     */
    protected function doPost(): BaseView {

        $id = $_GET["id"];
        if(empty($id) || !is_numeric($id)) {
            return new ErrorView("Cette publication n'existe pas.");
        }
        if(empty($_POST["formTitle"]) || empty($_POST["formContent"])) {
            return new ErrorView("Veuillez ne laisser aucun champ vide.");
        }
        $repo = new PublicationRepository;
        $oldPublication = $repo->findById($id);
        $picture = $oldPublication->getImageURL();
        if(isset($_FILES["picUpload"])) {
            $picture = parent::upload($_FILES["picUpload"]);
        }
        $altPublication = new Publication($_POST["formTitle"], $_POST["formContent"], $oldPublication->getDate(), $oldPublication->getLikes(), $oldPublication->getAuthor(), $picture, $oldPublication->getId());
        $repo->update($altPublication);
        return new RedirectView("/publication?id=".$id);
    }
}