<?php
namespace Time\Models;
use Phalcon\Mvc\Model;

class Time extends Model
{
    public function initialize()
    {
        $this->setSource('tracker');
        $this->belongsTo("user_id", 'Users', "id");


    }

}
