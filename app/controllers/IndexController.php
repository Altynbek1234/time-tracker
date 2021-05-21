<?php
namespace Time\Controllers;

class IndexController extends ControllerBase
{

    public function indexAction()
    {

        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $this->view->setTemplateBefore('public');

    }
}

