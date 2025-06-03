<?php

namespace App\View;

use App\Core\BaseView;

class PublicationUpdateView extends BaseView{

    public function __construct() {
        parent::__construct();
    }

    public function content () {

        ?>
            <form action="" method="post">
                <h1>Modifiez votre publication</h1>
                <input type="text" name="formUpdateAuthor" placeholder="Auteur">
                <input type="text" name="formUpdateTitle" placeholder="Titre de la publication">
                <input type="text" name="formUpdateContent" placeholder="Contenu de la publication">
                <button>Mettre à jour</button>
            </form>
        <?php
    }
}