<?php

namespace App\forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
//use Phalcon\Forms\Element\Radio;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;
class IndicationsForm extends BaseFormWrapper
{
    public function initialize() {
        $indicaciones = new Text(
            'description'
        );

        $indicaciones->addFilter('trim');

        $indicaciones->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $this->add($indicaciones);
    }
}