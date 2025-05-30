<?php

namespace App\View;

use App\Core\BaseView;

class HomeView extends BaseView{

    private array $publicationList;

    public function __construct(array $publications) {
        parent::__construct();
        $this->publicationList = $publications;
    }

    protected function content(){
        ?>
        <h1>Bienvenue sur Nom d'une Pipe !</h1>
        <p>Des trucs sur les pipes toutes les semaines !</p>
        <ul>
            <?php foreach($this->publicationList as $publication) {
                $article = new PublicationListView($publication);
                $article->publicationListContent();
            }
                ?>
        </ul>
        <?php
    }
}