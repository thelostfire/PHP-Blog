<?php

namespace App\View;

use App\Core\BaseView;
use App\Entity\Publication;
use App\Repository\CommentRepository;
use App\Repository\PublicationRepository;

class PublicationView extends BaseView{

    private Publication $toPublish;
    private $comments;

    public function __construct(private Publication $publication) {

        parent::__construct();

        $repo = new PublicationRepository();
        $repoComms = new CommentRepository();
        $this->toPublish = $repo->findById($this->publication->getId());
        $this->comments = $repoComms->findAllByPublication($publication);
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
                    echo "<img src=uploads/".$this->toPublish->getImageURL()." alt='ImageDeLaPublication'>";
                }?>
                
                <p>
                    <?=$this->toPublish->getContent()?>
                </p>
                <div>
                    <form method="post">
                        <input type="hidden" name="likes">
                        <button>Likes(<?=$this->toPublish->getLikes()?>)</button>
                    </form>
                    <div>
                        <a href="/update?id=<?=$this->toPublish->getId()?>">Modifier</a>
                        <form method="post">
                            <input type="hidden" name="deletePublication">
                            <button>Supprimer</button>
                        </form>
                    </div>
                </div>

            </article>
            <div>
                <form method="post">
                    <label for="commenterName">
                        <input type="text" name="commenterName" placeholder="Votre nom"></label>
                    <label for="comment">
                        <input type="text" name="comment" placeholder="Ajouter un commentaire">
                    </label>
                    <button>Commenter</button>
                </form>
            </div>
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