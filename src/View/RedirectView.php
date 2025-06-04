<?php

namespace App\View;

use App\Core\BaseView;

class RedirectView extends BaseView{
    public function __construct(private string $redirectLink) {
        parent::__construct();
    }

    public function render():void {
        header("Location: $this->redirectLink");
        exit;
    }
}