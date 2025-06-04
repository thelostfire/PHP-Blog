<?php

namespace App\View;

use App\Core\BaseView;
use App\Entity\Publication;

class PublicationFormView extends BaseView{

    private ?Publication $publication;

    public function __construct(?Publication $publication = null) {
       
        parent::__construct();
        $this->publication = $publication;
    }

    public function content() {
        
        $title = "Nouvelle publication";
        $disabled = "";
        $button = "Publier";
        if(!is_null($this->publication)) {
            $title = "Modification de publication";
            $disabled = "disabled";
            $button = "Modifier";
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <h1><?=$title?></h1>
            <input type="text" name="formAuthor" placeholder="Auteur" value="<?=$this->publication?->getAuthor()?>" <?=$disabled?>>
            <input type="text" name="formTitle" placeholder="Titre de la publication" value="<?=$this->publication?->getTitle()?>">
            <input type="text" name="formContent" placeholder="Contenu de la publication" value="<?=$this->publication?->getContent()?>">
            <div>
                <label> Téléversez votre image
                    <input type="file" name="picUpload" accept="image/*">
                </label>
                <button>
                    <?=$button?>
                </button>
            </div>
        </form>
        <?php
    }
}