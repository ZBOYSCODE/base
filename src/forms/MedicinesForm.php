<?php

namespace App\forms;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
//use Phalcon\Forms\Element\Radio;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class MedicinesForm extends  BaseFormWrapper
{
    public function initialize() {
        $obs = new Text(
            'description'
        );
        $obs->addFilter('trim');
        $obs->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $this->add($obs);

        $evol = new Select(
                'extra-medicamentos',
            [
                'Paracetamol Forte' => 'Paracetamol Forte',
                'Ambroxol Adulto' => 'Ambroxol Adulto',
                'Bisolvon Infantil' => 'Bisolvon Infantil',
            ]
        );
        $evol->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($evol);
    }
}