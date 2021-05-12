<?php

use Phalcon\Mvc\Controller;


class UserController extends ControllerBase
{


    public function indexAction()
    {
//        $this->assets
//            ->addJs('js/main.js');
        $time = Users::find();
        $time->toArray();
        $this->view->setVars(
            [
                'users' => $time
            ]
        );


    }






}