<?php
namespace Time\Models;
use Phalcon\Mvc\Model;

class Late extends Model
{
    public $id;
    public $late_time;

    public function initialize()
    {
        $this->setSchema("test");
        $this->setSource("late");
    }

    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Holidays|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}