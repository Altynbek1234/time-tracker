<?php
namespace Time\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;

class Latecomers extends Model
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $usersId;

    /**
     *
     * @var string
     */
    public $time;

    /**
     *
     * @var string
     */
    public $date;

    /**
     * Initialize method for model.
     */

    public function initialize()
    {
        $this->setSchema("test");
        $this->setSource("latecomers");
        $this->belongsTo('usersId', __NAMESPACE__ . '\Users', 'id', [
        'alias' => 'users',
        'reusable' => true
    ]);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'latecomers';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Latecomers[]|Latecomers|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Latecomers|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
