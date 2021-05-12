
<?php

use Phalcon\Mvc\Model;

class Time extends Model
{
    public function initialize()
    {
        $this->setSource('tracker');
        $this->hasMany("id", 'Users', "user_id");


    }

}
