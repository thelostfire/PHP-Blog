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


    private function upload(array $file): string {

            $uploadFolder=$_ENV["UPLOAD_FOLDER"];
            $filename=uniqid().".".pathinfo($file["name"])["extension"];
            if(!file_exists($uploadFolder)) {
                mkdir($uploadFolder);
            }
            move_uploaded_file($file["tmp_name"], "$uploadFolder/$filename");
            return $filename;   
    }
    public function doGet(): BaseView {
        return new PublicationFormView();
    }

    public function doPost(): BaseView {

        if(empty($_POST["formAuthor"]) || empty($_POST["formTitle"]) || empty($_POST["formContent"])) {
            return new ErrorView("Veuillez remplir tous les champs.");
        }
        $image = $_FILES["picUpload"];
        $picture = null;
        if(!empty($image)) {
            $picture = $this->upload($image);
            echo "<br>";
        }
        $repo = new PublicationRepository;
        $newPublication = new Publication($_POST["formTitle"], $_POST["formContent"], date("Y-m-d H-i-s"), 0, $_POST["formAuthor"], $picture);
        $repo->persist($newPublication);
        return new HomeView($repo->findAll());
    }
}