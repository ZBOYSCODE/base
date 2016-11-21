<?php

namespace App\forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
//use Phalcon\Forms\Element\Radio;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class BaseForm extends BaseFormWrapper
{
    public function initialize() {
        $eval = new Text(
            'status'
        );
        $eval->addValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($eval);
    }
}