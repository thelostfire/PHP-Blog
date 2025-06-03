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
        if(!is_null($this->publication)) {
            $title = "Modification de publication";
            $disabled = "disabled";
        }
        ?>
        <form action="" method="post">
            <h1><?=$title?></h1>
            <input type="text" name="formAuthor" placeholder="Auteur" value="<?=$this->publication?->getAuthor()?>" <?=$disabled?>>
            <input type="text" name="formTitle" placeholder="Titre de la publication" value="<?=$this->publication?->getTitle()?>">
            <input type="text" name="formContent" placeholder="Contenu de la publication" value="<?=$this->publication?->getContent()?>">
            <div>
                <button>
                    Télécharger une image
                </button>
                <button>
                    Publier
                </button>
            </div>
        </form>
        <?php
    }
}