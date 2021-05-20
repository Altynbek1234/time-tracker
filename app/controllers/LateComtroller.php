<?php
use Phalcon\Http\Response as Response;

class EmployeeController extends \Time\Controllers\ControllerBase
{

    public function indexAction()
    {
        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $this->view->setTemplateBefore('public');
        $this->view->holidays = Late::find();
    }

    public function saveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "holidays",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $holiday = Holidays::findFirstByid($id);

        if (!$holiday) {
            $this->flash->error("holidays does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "holidays",
                'action' => 'index'
            ]);

            return;
        }

        $holiday->name = $this->request->getPost("name");
        $holiday->dateHoliday = $this->request->getPost("day");
        $holiday->dateHoliday = $this->request->getPost("month");
        $holiday->active = $this->request->getPost("active");


        if (!$holiday->save()) {

            foreach ($holiday->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "holidays",
                'action' => 'edit',
                'params' => [$holiday->id]
            ]);

            return;
        }

        $this->flash->success("holidays was updated successfully");

        $this->dispatcher->forward([
            'controller' => "holidays",
            'action' => 'index'
        ]);
    }

    public function editAction(){
        $this->view->disable();

        $res = new Response;

        $id = $this->request->getPost('id');
        $emp = Late::findFirst($id);

        $res->setContent( json_encode( array(
            'emp_id'=>$emp->emp_id,
            'emp_fullname'=>$emp->emp_fullname,
            'emp_nickname'=>$emp->emp_nickname,
            'emp_email'=>$emp->emp_email
        ) ) );

        return $res;
    }

    public function deleteAction()
    {
        $this->view->disable();

        $res = new Response;

        $id = $this->request->getPost('emp_id');
        $emp = Late::findFirst($id);

        if (! $emp->delete()) {
            $return = array('return' => false, 'msg' => 'Error ! while deleting data');
        } else {
            $return = array('return' => true);
        }

        $res->setContent( json_encode( $return ) );

        return $res;
    }

}
