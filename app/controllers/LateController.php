<?php

namespace Time\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Time\Models\Late;


class LateController extends ControllerBase
{
    public function indexAction()
    {

        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $this->view->setTemplateBefore('public');
        $this->view->late = Late::find();

    }

    public function editAction($id)
    {
        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $this->view->setTemplateBefore('public');
        $late = Late::find();

        if (!$this->request->isPost()) {

            $late = Late::findFirstByid($id);

            if (!$late) {
                $this->flash->error("holidays was not found");

                $this->dispatcher->forward([
                    'controller' => "late",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $late->id;

            $this->tag->setDefault("id", $late->id);
            $this->tag->setDefault("late_time", $late->late_time);

        }
    }

    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "late",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $late = late::findFirstByid($id);

        if (!$late) {
            $this->flash->error(" does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "late",
                'action' => 'index'
            ]);

            return;
        }

        $late->late_time = $this->request->getPost("late_time");


        if (!$late->save()) {

            foreach ($late->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "late",
                'action' => 'edit',
                'params' => [$late->id]
            ]);

            return;
        }

        $this->flash->success("was updated successfully");

        $this->dispatcher->forward([
            'controller' => "late",
            'action' => 'index'
        ]);
    }


}
