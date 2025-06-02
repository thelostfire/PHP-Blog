<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Core\BaseView;
use App\View\PublicationFormView;

class PublicationFormController extends BaseController{

    public function doGet(): BaseView {
        return new PublicationFormView();
    }
}