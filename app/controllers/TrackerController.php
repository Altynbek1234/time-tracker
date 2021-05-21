<?php

namespace Time\Controllers;


use Time\Models\LateComers;
use Time\Models\Late;
use Time\Models\Time;
use Time\Models\Users;
use DateTime;
use DateTimeZone;



class TrackerController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->setTemplateBefore('public');
        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));

        $userId = '';
        if ($this->session->has('id')) {
            // Получение значения
            $userId = $this->session->get('id');
        }
        $dates = Time::allDayInMonth();
        $users = Users::find();
        $this->view->setVars(
        [
            'dates' => $dates,
            'userId' => $userId,
            'users'=> $users,
        ]

    );


        $this->assets->addJs('js/main.js');
    }

    public function testAction()
    {
        $user_id = '';
        if ($this->session->has('id')) {
            // Получение значения user id
            $user_id = $this->session->get('id');
        }
        $state = "";
        if (isset($_POST['state'])) {
            $state = $_POST['state'];
        }
        $date = new DateTime('now', new DateTimeZone('Asia/Bishkek'));
        $time_now = $date->format('H:i');
        $today = $date->format("Y-m-d ");

        if ($state == "start") {
            $time = new Time();

            $time->started_time = $time_now;
            $late = Late::findFirst();
            $isExist = LateComers::findFirst([
                'conditions' => 'usersId = :user_id: AND date = :today:',
                'bind' => [
                    'user_id' => $user_id,
                    'today' => $today,
                ]
            ]);
            if(!count($isExist->date)){

                if(strtotime($time->started_time) > strtotime($late->late_time)) {
                    $userLate = new LateComers();
                    $userLate->usersId = $user_id;
                    $userLate->time = $time_now;
                    $userLate->date = $today;
                    if ($userLate->save() === false) {
                        $messages = $userLate->getMessages();
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    } else {
                        echo "Great, a new robot was saved successfully!";
                    }
                }

            }


            $time->state = $state;
            $time->user_id = $user_id;
            $time->date = $today;
            $time->save();
            $this->session->set('last_time_id', $time->id);
        } else if ($state == "stop") {
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
            $last = $time->getLast();
            $start = $last->started_time;
            $stop = $last->stopped_time;
            $work_time = (strtotime($start) - strtotime($stop)) / 60;


            $time = Time::find([
                'conditions' => 'user_id = :id:',
                'bind' => [
                    'id' => $user_id
                ]
            ]);
            $sum = 0;
            foreach ($time as $item) {
                $sum = $sum + intval($item->work_time);
            }
            $hours = Time::changeFormatTime($sum);
            $last->work_time = abs($work_time);
            $last->total_time = $hours;
            $last->update();
        }
        return json_encode($time);
    }
}