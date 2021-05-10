<?php

use Phalcon\Mvc\Model;

class Time extends Model
{
    public function initialize()
    {
        $this->setSource('time');
    }

}
