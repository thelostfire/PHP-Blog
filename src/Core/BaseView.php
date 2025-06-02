<?php

namespace App\Core;

use App\View\Parts\Header;
use App\View\Parts\Footer;

class BaseView {


    private $header;
    private $footer;

    public function __construct() {
        $this->header = new Header();
        $this->footer = new Footer();
    }

    protected function content() {
        throw new \Exception("There is no content to display");
    }
    public function render() {
        $this->header->render();
        
        $this->content();

        $this->footer->render();
        
    }
}