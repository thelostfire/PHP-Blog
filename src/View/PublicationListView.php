<?php

namespace App\View;

use App\Core\BaseView;
use App\Entity\Publication;

class PublicationListView{


    public function __construct(private Publication $publication) {}

    public function publicationListContent() {
        echo "<li><article><h2>".$this->publication->getTitle()."</h2><p>".$this->publication->getAuthor().", le ".$this->publication->getDate()."</p></article></li>";
    }
}