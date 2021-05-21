<?php


namespace Time\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Criteria;
use Time\Forms\LatecomersForm;
use Time\Models\Latecomers;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Time\Models\Users;


class LatecomersController extends ControllerBase
{
    /**
     * Default action. Set the private (authenticated) layout (layouts/private.volt)
     */
    public function initialize()
    {
        $this->view->setTemplateBefore('private');
    }

    /**
     * Default action, shows the search form
     */
    public function indexAction()
    {

        $this->persistent->conditions = null;
        $this->view->form = new LatecomersForm();
    }

    /**
     * Searches for profiles
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Time\Models\Latecomers', $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }


        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }



        $latecomers = Latecomers::find($parameters);
        if (count($latecomers) == 0) {
            $this->flash->notice("The search did not find any latecomers");

            return $this->dispatcher->forward([
                "action" => "index"
            ]);
        }
        $paginator = new Paginator([
            "data" => $latecomers,
            "limit" => 10,
            "page" => $numberPage
        ]);
//        print_die($paginator);

        $this->view->page = $paginator->getPaginate();
    }


    public function editAction($id)
    {
        $latecomers = Latecomers::findFirstById($id);
        if (!$latecomers) {
            $this->flash->error("Profile was not found");
            return $this->dispatcher->forward([
                'action' => 'index'
            ]);
        }

        if ($this->request->isPost()) {
            $latecomers->assign([
                'name' => $this->request->getPost('name', 'striptags'),
                'active' => $this->request->getPost('active')
            ]);

            if (!$latecomers->save()) {
                $this->flash->error($latecomers->getMessages());
            } else {
                $this->flash->success("Profile was updated successfully");
            }
        }

        $this->view->form = new LatecomersForm($latecomers, [
            'edit' => true
        ]);
        $this->view->form->clear();


        $this->view->latecomers = $latecomers;
    }



}