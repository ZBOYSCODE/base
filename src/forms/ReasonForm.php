<?php
/**
 * Created by PhpStorm.
 * User: Jorge Cociña
 * Date: 13-10-2016
 * Time: 11:57
 */

namespace App\forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
//use Phalcon\Forms\Element\Radio;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class ReasonForm extends BaseFormWrapper
{
    public function initialize() {

        $motivo = new Text(
            'description'
        );
        
        $motivo->addFilter('trim');

        $motivo->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $this->add($motivo);
    }
}