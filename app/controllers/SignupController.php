<?php

use Phalcon\Mvc\Controller;



class SignupController extends ControllerBase
{
    public function indexAction()
    {

    }

    public function registerAction()
       {
//           print_die('hello');
//           $now = new DateTime("now", new DateTimeZone('Asia/Bishkek') );
//            print_die($now);


        $user = new Users();
        // Store and check for errors
            $success = $user->save(
                $this->request->getPost(),
                [
                    "name",
                    "email",
                ]
            );

        if ($success) {
            echo "Спасибо за регистрацию!";
        } else {
            echo "К сожалению, возникли следующие проблемы: ";

            $messages = $user->getMessages();

            foreach ($messages as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }
//
//        $this->view->disable();
//        $time = new Time();
//        var_dump($time);
        print_die('dfdfd');
    }

}
