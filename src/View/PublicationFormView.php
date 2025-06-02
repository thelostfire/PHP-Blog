<?php

namespace App\View;

use App\Core\BaseView;

class PublicationFormView extends BaseView{

    public function content() {
        ?>
        <form action="">
            <h1>Nouvelle Publication</h1>
            <input type="text" name="formAuthor" placeholder="Auteur">
            <input type="text" name="formTitle" placeholder="Titre de la publication">
            <input type="text" name="formContent" placeholder="Contenu de la publication">
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