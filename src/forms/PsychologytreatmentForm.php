<?php
/**
 * Created by PhpStorm.
 * User: Jorge Cociña
 * Date: 13-10-2016
 * Time: 11:50
 */

namespace App\forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
//use Phalcon\Forms\Element\Radio;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;
class PsychologytreatmentForm extends  BaseFormWrapper
{
    public function initialize() {
        $lograr = new Text(
            'extra-qué-se-puede-lograr'
        );
        $lograr->addFilter('trim');
        $lograr->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $this->add($lograr);
    }
}