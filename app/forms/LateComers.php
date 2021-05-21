<?php

namespace Time\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Date;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Timetracker\Forms\ProfilesForm
 * @package Timetracker\Forms
 */
class LateComersForm extends Form
{

    public function initialize($entity = null, $options = null)
    {


        $date = new Date('date');
        $date->setLabel('date');
        $date->addValidators([
            new PresenceOf([
                'message' => 'The name is required'
            ])
        ]);
        $this->add($date);

    }
}
