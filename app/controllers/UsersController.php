<?php



namespace Time\Controllers;

use Phalcon\Tag;
use Time\Models\Users;
use Time\Models\Time;
use Time\Forms\TimeForm;
use Time\Forms\UsersForm;
use Phalcon\Mvc\Model\Criteria;
use Time\Models\PasswordChanges;
use Time\Forms\ChangePasswordForm;
use Phalcon\Paginator\Adapter\Model as Paginator;

/**
 * CRUD to manage users
 * Time\Controllers\UsersController
 * @package Time\Controllers
 */
class UsersController extends ControllerBase
{
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
        $this->view->form = new UsersForm();
        $this->assets->addJs('js/main.js');

        $time = Users::find();
        $time->toArray();
        $this->view->setVars(
            [
                'users' => $time
            ]
        );
    }

    /**
     * Searches for users
     */


    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Time\Models\Users', $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $users = Users::find($parameters);
        if (count($users) == 0) {
            $this->flash->notice("The search did not find any users");
            return $this->dispatcher->forward([
                "action" => "index"
            ]);
        }

        $paginator = new Paginator([
            "data" => $users,
            "limit" => 10,
            "page" => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Creates a User
     */
    public function createAction()
    {
        $form = new UsersForm(null);

        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost()) == false) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $user = new Users([
                    'name' => $this->request->getPost('name', 'striptags'),
                    'profilesId' => $this->request->getPost('profilesId', 'int'),
                    'email' => $this->request->getPost('email', 'email')
                ]);

                if (!$user->save()) {
                    $this->flash->error($user->getMessages());
                } else {
                    $this->flash->success("User was created successfully");

                    $form->clear();
                }
            }
        }

        $this->view->form = $form;
    }

    /**
     * Saves the user from the 'edit' action
     */
    public function editAction($id)
    {
        $user = Users::findFirstById($id);

        if (!$user) {
            $this->flash->error("User was not found");
            return $this->dispatcher->forward([
                'action' => 'index'
            ]);
        }

        if ($this->request->isPost()) {
            $user->assign([
                'name' => $this->request->getPost('name', 'striptags'),
                'profilesId' => $this->request->getPost('profilesId', 'int'),
                'email' => $this->request->getPost('email', 'email'),
                'banned' => $this->request->getPost('banned'),
                'suspended' => $this->request->getPost('suspended'),
                'active' => $this->request->getPost('active')
            ]);

            $form = new UsersForm($user, [
                'edit' => true
            ]);

            if ($form->isValid($this->request->getPost()) == false) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                if (!$user->save()) {
                    $this->flash->error($user->getMessages());
                } else {
                    $this->flash->success("User was updated successfully");

                    $form->clear();
                }
            }
        }

        $this->view->user = $user;

        $this->view->form = new UsersForm($user, [
            'edit' => true
        ]);
    }

    /**
     * Deletes a User
     *
     * @param int $id
     */
    public function deleteAction($id)
    {
        $user = Users::findFirstById($id);
        if (!$user) {
            $this->flash->error("User was not found");
            return $this->dispatcher->forward([
                'action' => 'index'
            ]);
        }

        if (!$user->delete()) {
            $this->flash->error($user->getMessages());
        } else {
            $this->flash->success("User was deleted");
        }

        return $this->dispatcher->forward([
            'action' => 'index'
        ]);
    }

    /**
     * Users must use this action to change its password
     */
    public function timeAction($id)
    {

        $user = Users::findFirstById($id);

        if (!$user) {
            $this->flash->error("User was not found");
            return $this->dispatcher->forward([
                'action' => 'index'
            ]);
        }

        if ($this->request->isPost()) {
            $user->assign([
                'name' => $this->request->getPost('name', 'striptags'),
                'profilesId' => $this->request->getPost('profilesId', 'int'),
                'email' => $this->request->getPost('email', 'email'),
                'banned' => $this->request->getPost('banned'),
                'suspended' => $this->request->getPost('suspended'),
                'active' => $this->request->getPost('active'),
                'password' => $this->security->hash($this->request->getPost('password'))
            ]);
            if ($user->save()) {
                $this->flash->success("User was updated successfully");
            }
        }

        $this->view->user = $user;

        $this->view->form = new UsersForm($user, [
            'edit' => true
        ]);
    }


    public function changePasswordAction()
    {
        $form = new ChangePasswordForm();

        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $user = $this->auth->getUser();

                $user->password = $this->security->hash($this->request->getPost('password'));
                $user->mustChangePassword = 'N';

                $passwordChange = new PasswordChanges();
                $passwordChange->user = $user;
                $passwordChange->ipAddress = $this->request->getClientAddress();
                $passwordChange->userAgent = $this->request->getUserAgent();

                if (!$passwordChange->save()) {
                    $this->flash->error($passwordChange->getMessages());
                } else {
                    $this->flash->success('Your password was successfully changed');

                    $form->clear();
                }
            }
        }

        $this->view->form = $form;
    }

    public function updateAction($id)
    {
        $workTime = Time::findFirstById($id);
        $userArray = $workTime->toArray();
        $userId = $userArray["user_id"];
        if(!$workTime){
            $this->flash->error('Work time was not found');
            $this->response->redrect('/timesheet');
            return;
        }
        $this->view->userId = $userId;
//        print_die($workTime->toArray());
            $this->view->form = new TimeForm($workTime, ['edit' => true]);
    }

    public function saveAction()
    {
        // print_die(123);
        if(!$this->request->isPost()){
            $this->response->redirect('/user');
        }
        $workTimeId = $this->request->getPost('id');
        $workTime = TimeData::findFirstById($workTimeId);
        $userId = $workTime->getUserId();
        if(!$workTime){
            $this->flash->error('WorkTime was not found');
            $this->dispatcher->forward([
                'action'     => 'index',
                'params'     => [$userId],
            ]);
        }
        $form = new TimeForm();
        $this->view->form = $form;
        $data = $this->request->getPost();
        if(!$form->isValid($data, $workTime)){
            $this->flash->error('Form is not valid!');

            $this->dispatcher->forward([
                'action'     => 'update',
                'params'     => [$workTimeId],
            ]);
        }
        if(!$workTime->save()){
            $this->flash->error('Form is not save!');

            $this->dispatcher->forward([
                'action'     => 'update',
                'params'     => [$workTimeId],
            ]);
        }
        $form->clear();
        $this->flash->success('WorkTime was updated successfully');
        $this->dispatcher->forward([
            'action'     => 'index',
            'params'     => [$userId],
        ]);
    }



}
