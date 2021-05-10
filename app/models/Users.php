<?php

use Phalcon\Mvc\Model;

class Users extends Model
{

    public function initialize()
    {
        $this->setSource('users');
        $this->hasMany('user_id', 'Users', 'user_id');
    }
}