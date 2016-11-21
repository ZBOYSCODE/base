<?php
/**
 * Created by PhpStorm.
 * User: Jorge Cociña
 * Date: 13-10-2016
 * Time: 14:45
 */

namespace App\forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
//use Phalcon\Forms\Element\Radio;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;
class ProcedureForm extends BaseFormWrapper
{
    public function initialize() {
        $procedimiento = new Select(
            'extra-procedimientos',
            [
                'Atención' => 'Atención',
                'Cirugía Dental' => 'Cirugía Dental',
                'Audiograma' => 'Audiograma',
                'Electrocardiograma' => 'Electrocardiograma',
                'Test Psicológico' => 'Test Psicológico',
            ]
        );
        $procedimiento->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($procedimiento);
    }
}