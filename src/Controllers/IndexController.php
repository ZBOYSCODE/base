<?php

namespace App\Controllers;



class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->pick("controllers/home/_index");
    }

}