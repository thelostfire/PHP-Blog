<?php

namespace App\View;

use App\Core\BaseView;
use App\Entity\Publication;
use App\Repository\CommentRepository;
use App\Repository\PublicationRepository;

class PublicationView extends BaseView{

    private $toPublish;
    private $comments;

    public function __construct(private Publication $publication) {

        parent::__construct();

        $repo = new PublicationRepository();
        $repoComms = new CommentRepository();
        $this->toPublish = $repo->findById($this->publication->getId());
        $this->comments = $repoComms->findAllByPublicationId($this->publication->getId());
    }

    public function content() {
        
        if(is_null($this->toPublish)) {
            echo "<h1>No such publication was found in our records...</h1>";
        }
        else {
            ?>
            <article>
                <p><?=$this->toPublish->getAuthor()?>, le <?=$this->toPublish->getDate()?></p>
                <h1><?=$this->toPublish->getTitle()?></h1>
                <?php if(!is_null($this->toPublish->getImageURL())) {
                    echo "<img src=".$this->toPublish->getImageURL()." alt='ImageDeLaPublication'>";
                }?>
                
                <p>
                    <?=$this->toPublish->getContent()?>
                </p>
                <form method="post">
                    <input type="hidden">
                    <button>Likes(<?=$this->toPublish->getLikes()?>)</button>
                </form>

            </article>
            <ul>
                <?php
                foreach($this->comments as $comment) {
                    echo "<p>".$comment->getContent()."</p><p>Commentaire de ".$comment->getAuthor().", le ".$comment->getDate();
                }
                ?>
            </ul>

            <?php
        }
    }
}