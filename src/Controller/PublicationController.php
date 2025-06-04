<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Core\BaseView;
use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\PublicationRepository;
use App\View\ErrorView;
use App\View\HomeView;
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

    protected function doPost(): BaseView {

            $id = $_GET["id"];
            $repo = new PublicationRepository;
            if(isset($_POST["likes"])) {
                $publi = $repo->findById($id);
                $publi->setLikes($publi->getLikes() + 1);
                $repo->update($publi);
                return new PublicationView($repo->findById($id));
            }
            if(isset($_POST["deletePublication"])) {
                $repo->delete($id);
                return new HomeView($repo->findAll());
            }
            if(isset($_POST["commenterName"]) && isset($_POST["comment"])) {
                
                if(empty($_POST["commenterName"]) || empty($_POST["comment"])) {
                    return new ErrorView("Veuillez remplir tous les champs du commentaire");
                }
                $commRepo = new CommentRepository;
                $comm = new Comment($_POST["comment"], date("Y-m-d H-i-s"), 0, $_POST["commenterName"], $id);
                $commRepo->persist($comm);
                return new PublicationView($repo->findById($id));
                
            }
            return new HomeView($repo->findAll());
    }
}