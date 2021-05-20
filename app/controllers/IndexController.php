<?php
namespace Time\Controllers;

class IndexController extends ControllerBase
{
    public function index()
    {
//        print_die(1);
        // Добавляем некоторые локальные CSS ресурсы
//        $this->assets->addCss('css/style.css');
//        $this->assets->addCss('css/index.css');

        // А теперь некоторые локальные JavaScript ресурсы
        //$this->assets->addJs('js/main.js');
       // $this->assets->addJs('js/bootstrap.min.js');
    }
    public function indexAction()
    {

        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $this->view->setTemplateBefore('public');

       // $this->assets->addJs('js/main.js');

// and some local javascript resources

//            ->addJs('js/bootstrap.min.js');

//        $user = Users::find();
//        foreach ($user as $user) {
//            print_die($user->email);
//
//        }
//        print_die($user);

//        $this->view->setVar('all', $user);

//        print_die($user->toArray());
//          $times = Time::find();
//          print_die($times->toArray());
    }

//        $this->view->setVar('all', $user);
}

