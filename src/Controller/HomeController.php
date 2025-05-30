<?php 

namespace App\Controller;

use App\Core\BaseController;
use App\Core\BaseView;
use App\Repository\PublicationRepository;
use App\View\HomeView;

class HomeController extends BaseController{

    protected function doGet():BaseView {

        $repo = new PublicationRepository();
        return new HomeView($repo->findAll());
    }
}