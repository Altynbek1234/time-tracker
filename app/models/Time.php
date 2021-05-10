<?php

use Phalcon\Mvc\Model;

class Time extends Model
{
    public function initialize()
    {

        $this->hasMany('user_id', 'Users', 'user_id');
    }

}
