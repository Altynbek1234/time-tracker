<?php
namespace Time\Controllers;

//use Phalcon\Mvc\Controller;
use http\Client\Curl\User;
use Time\Models\Time;
use Time\Models\Users;
use DateTime;
use DateTimeZone;

//use Time\Models\Time;


class TrackerController extends ControllerBase
{


    public function indexAction(    )
    {
//        $this->assets
//            ->addJs('js/main.js');

        $this->assets->addJs('js/main.js');


    }

    public function testAction()
    {

        $user_id = '';
        if ($this->session->has('id')) {
            // Получение значения
            $user_id = $this->session->get('id');

        }

        $state = "";

        if(isset($_POST['state'])){
            $state = $_POST['state'];
        }

        $date = new DateTime('now', new DateTimeZone('Asia/Bishkek'));
        $time_now = $date->format('H:i');
        if($state == "start"){

            $time = new Time();
            $time->started_time = $time_now;
            $time->state = $state;
            $time->user_id = $user_id;
            $time->save();
            $this->session->set('last_time_id', $time->id);
        }else if($state == "stop"){

            $last_id = $this->session->get('last_time_id');
            $time = Time::findFirst([
                'conditions' => 'id = :id:',
                'bind' => [
                    'id' => $last_id
                ]
            ]);

            $time->stopped_time = $time_now;
            $time->state = 'stop';

            $time->update();
            $time = Time::find();


        }


        $time = Time::find();

        $last = $time->getLast();
//        print_die($last->toArray());
        $start = $last->started_time;
        $stop = $last->stopped_time;

        $work_time = (strtotime($start) - strtotime($stop) ) / 60;

        $time = Time::find([
            'conditions' => 'user_id = :id:',
            'bind' => [
                'id' => $user_id
            ]
        ]);

        $sum = 0;
        foreach ($time as $i){
            $sum = $sum + intval($i->work_time);
        }

        $total_time = $last->total_time;

        function hour_min($minutes){// Total
            if($minutes <= 0) return '00 Hours 00 Minutes';
            else
                return sprintf("%02d",floor($minutes / 60)).':'.sprintf("%02d",str_pad(($minutes % 60), 2, "0", STR_PAD_LEFT)). "";
        }
//        print_die(hour_min($total_time));

        $last->work_time = abs($work_time);
        $last->total_time = hour_min($sum);
        $last->update();
        return json_encode($time);

    }
    public function timesAction()
    {
//        $this->assets
//            ->addJs('js/main.js');

//        $time = Time::query()
//        ->where('user_id = :id:')
//        ->bind(['id' => $id])
//        ->execute();
//
//        if ($this->session->has('id')) {
//            // Получение значения
//            $name = $this->session->get('id');
//            print_die($name);
//        }


//        $time->toArray();
//        print_die($time->toArray());
//        print_die($id);






//        $time = Time::find();
//        $last = $time->getLast();
//        $start = $last->started_time;
//        $stop = $last->stopped_time;
//        $result = (strtotime($start) - strtotime($stop) ) / 60;
//        print_die($result);
//        $time = Time::find();
//        $time->toArray();
//        print_die($time->toArray());

//        $this->view->setVars(
//            [
//                'times' => $time
//            ]
//        );



    }

    public function staffAction()
    {


        $time = Time::find();
        $last = $time->getLast();
        $start = $last->started_time;
        $stop = $last->stopped_time;
        $result = (strtotime($start) - strtotime($stop) ) / 60;
        print_die($result);


//        print_die(abs($result));
//        if (isset($_POST['start'])) {
//            $date = new DateTime('now', new DateTimeZone('Asia/Bishkek'));
//            $start_time = $date->format('H:i:s');
////            print_die($start_time);
//
//            $time->started_time = $start_time;
//
//            if ($time->save() === false) {
//                $messages = $time->getMessages();
//
//                foreach ($messages as $message) {
//                    echo $message, "\n";
//                }
//
//            } else {
////                $this->response->redirect('');
//                print_die(132);
//
//            }
//        } elseif (isset($_POST['stop'])) {
//            $date = new DateTime('now', new DateTimeZone('Asia/Bishkek'));
//            $stop_time = $date->format('H:i:s');
////            print_die($stop_time);
////            $test = intval($this->request->getPost("test"));
////            $test = 46;
////            $time = Time::findFirst("id = $test");
////            print_die($time->toArray());
//            $time->stop_time = $stop_time;
////            $time->stopped_time = $stop_time;
//            $time->save();
//            if ($time->save() === false) {
//                echo "didnt wrote \n";
//                $messages = $time->getMessages();
//
//                foreach ($messages as $message) {
//                    echo $message, "\n";
//                }
//
//
//            } else {
//
//                return $this->response->redirect($this->request->getHTTPReferer());
//
//            }
//        }
        $time = new Time();
        if (isset($_POST['start'])) {
            $date = new DateTime('now', new DateTimeZone('Asia/Bishkek'));
            $start_time = $date->format('H:i:s');
//            print_die($start_time);

            $time->started_time = $start_time;

            if ($time->save() === false) {
                $messages = $time->getMessages();

                foreach ($messages as $message) {
                    echo $message, "\n";
                }

            } else {
//                $this->response->redirect('');
                print_die(132);

            }
        } elseif (isset($_POST['stop'])) {
            $date = new DateTime('now', new DateTimeZone('Asia/Bishkek'));
            $stop_time = $date->format('H:i:s');
//            print_die($stop_time);
//            $test = intval($this->request->getPost("test"));
//            $test = 46;
//            $time = Time::findFirst("id = $test");
//            print_die($time->toArray());
            $time->stop_time = $stop_time;
//            $time->stopped_time = $stop_time;
            $time->save();
            if ($time->save() === false) {
                echo "didnt wrote \n";
                $messages = $time->getMessages();

                foreach ($messages as $message) {
                    echo $message, "\n";
                }


            } else {

                return $this->response->redirect($this->request->getHTTPReferer());

            }
        }

//        $this->assets
//            ->addJs('js/main.js');


//        print_die($name);

//        $robotsParts = $time->getUsers();
//        print_die($robotsParts);


    }




}