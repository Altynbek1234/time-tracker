<?php

namespace Time\Controllers;

use Time\Models\Users;
use Time\Models\FiledLogins;
use Time\Forms\LoginForm;
use Time\Forms\SignUpForm;
use Time\Exception\Exception;
use Time\Models\ResetPasswords;

/**
 * Controller used handle non-authenticated session actions like login/logout, users signup, and forgotten passwords
 * Timetracker\Controllers\SessionController
 * @package Timetracker\Controllers
 */
class SessionController extends ControllerBase
{
    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function initialize()
    {
        $this->view->setTemplateBefore('public');
    }

    public function indexAction()
    {
    }

    /**
     * Allow a users to signup to the system
     */
    public function signupAction()
    {

        $form = new SignUpForm();
        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost()) != false) {
                $user = new Users([
                    'name' => $this->request->getPost('name', 'striptags'),
                    'login' => $this->request->getPost('login'),
                    'email' => $this->request->getPost('email'),
                    'role' => $this->request->getPost('role'),
                    'status' => $this->request->getPost('status'),
                    'password' => $this->security->hash($this->request->getPost('password')),
                    'profilesId' => 2
                ]);


                if ($user->save()) {
                    return $this->dispatcher->forward([
                        'controller' => 'index',
                        'action' => 'index'
                    ]);
                }
                $this->flash->error($user->getMessages());
//                $this->session->set('email', $email);
            }
        }
        $this->view->form = $form;
    }

    public function registerSession($user)
    {
        $this->session->set('auth', [
            'id' => $user->id,
            'role' => $user->role
        ]);
    }


    public function authAction()
    {

        $form = new LoginForm();

        if ($this->request->isPost()) {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $user = Users::findFirst([
                "conditions" => "email = ?0",
                "bind" => [
                    $email,
                ]
            ]);
//            $id = $user->id;
//            $this->session->set('id', $id);

            if ($user !== false) {
                if ($this->auth->check(

                    [   'email' => $this->request->getPost('email'),
                        'password' => $this->request->getPost('password')
                    ]
                )) {
                    if ($user->active == "N") {
                        $this->flash->error("User Deactivated");
                        return $this->response->redirect('tracker');
                    }

                    $this->registerSession($user);
                    if ($user->role == 'admin') {
                        return $this->dispatcher->forward([
                            'controller' => 'admin',
                            'action' => 'index'
                        ]);
                    }
                    return $this->response->redirect('tracker');

                }
            }
            return $this->response->redirect('tracker/');
        }
        $this->view->form = $form;
    }

    /**
     * Starts a session in the admin backend
     */
    public function loginAction()
    {

        $form = new LoginForm();

        try {
            if (!$this->request->isPost()) {
                if ($this->auth->hasRememberMe()) {
                    return $this->auth->loginWithRememberMe();
                }
            } else {
                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {

                    $this->auth->check([
                        'email' => $this->request->getPost('email'),
                        'password' => $this->request->getPost('password'),
                        'remember' => $this->request->getPost('remember')

                    ]);

                    return $this->response->redirect('tracker');
                }
            }
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->form = $form;
    }

    /**
     * Closes the session
     */
    public function logoutAction()
    {
        $this->auth->remove();
        return $this->response->redirect('index');
    }

    public function homeAction()
    {
    }
}