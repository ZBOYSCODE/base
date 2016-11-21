<?php


namespace App\forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
//use Phalcon\Forms\Element\Radio;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;
class DiagnosisForm extends BaseFormWrapper
{
    public function initialize() {
        $diagnostico = new Select(
            'extra-diagnostico',
            [
                '1' => 'Mástitis Crónica',
                '2' => 'Mástitis fibroquística',
                '3' => 'Mástitis flemonosa',
                '4' => 'Mástitis infecciosa',
                '5' => 'Mástitis neonatal',
                '6' => '(Próximamente todo el CIE-10)',
            ]
        );
        $diagnostico->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($diagnostico);

        $tipoDiag = new Select(
            'extra-tipo-diagnostico',
            [
                'Si' => 'Hipotesis',
                'No' => 'Confirmado',
            ]
        );
        $tipoDiag->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($tipoDiag);

        $complementoDiag = new Text(
            'description'
        );

        $complementoDiag->addFilter('trim');

        $complementoDiag->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $this->add($complementoDiag);
    }
}