<?php

namespace App\View;

use App\Core\BaseView;
use App\Entity\Publication;

class PublicationListView extends BaseView{


    private $publication;
    public function __construct( Publication $publication) {
        $this->publication = $publication;
    }

    public function publicationListContent() {
        
        ?>
        <li>
            <article>
                <h2><a href="/publication?id=<?=$this->publication->getId()?>"><?=$this->publication->getTitle()?></a></h2>
                <p><?=$this->publication->getAuthor()?>, le <?=$this->publication->getDate()?></p>
            </article>
        </li>
        <?php
    }
}