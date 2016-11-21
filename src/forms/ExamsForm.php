<?php
namespace App\forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class ExamsForm extends \App\forms\BaseFormWrapper
{
    public function set($param) {
        
        

        $exams = new Select(
            'extra-examenes',
            [
                'Análisis de Sangre' => 'Análisis de Sangre',
                'TAC' => 'TAC',
                'Endoscopía' => 'Endoscopía',
                'Bactereológico' => 'Bactereológico',
            ]
        );
        $exams->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );

        $this->add($exams);


        if($param['extra-cantidad-examenes']){


            $cant = new Text(
                'extra-cantidad-examenes'
            );

            $cant->AddValidators(
                array(
                    new Numericality(
                        array(
                            'message' => NUMERIC
                        )
                    )
                )
            );
            $this->add($cant); 

        }else{

            $cant = new Text(
                'extra-cantidad-examenes'
            );
            $cant->addFilter('trim');

            $cant->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );

            $this->add($cant);

           
        }


    }
}