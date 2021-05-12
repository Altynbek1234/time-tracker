<?php
//
use Phalcon\Mvc\Model;

class Users extends Model
{
//    public $id;
//    public $login;
//    public $name;
//    public $password;
//    public $role;
//    public $status;
//
    public function initialize()
    {
        $this->belongsTo(
            'user_id',
            'Time',
            'id'
        );

    }
//
//
}