<?php

namespace App\forms;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
//use Phalcon\Forms\Element\Radio;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;
class PsychologyreasonForm extends BaseFormWrapper
{
    public function set($param)
    {

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

        $antecedentes = new Text(
            'extra-antecedentes-psicologicos-personales'
        );
        
        $antecedentes->addFilter('trim');

        $antecedentes->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $this->add($antecedentes);


        $extConsumAlcohol = new Select(
            'extra-consume-alcohol',
            [
                'Sí' => 'Sí',
                'NO' => 'NO',
            ]
        );
        $extConsumAlcohol->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );

        $this->add($extConsumAlcohol);

        $extConsumSpa = new Select(
            'extra-consume-spa',
            [
                'Sí' => 'Sí',
                'NO' => 'NO',
            ]
        );
        $extConsumSpa->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );

        $this->add($extConsumSpa);

        $extConsumTabaco = new Select(
            'extra-consume-tabaco',
            [
                'Sí' => 'Sí',
                'NO' => 'NO',
            ]
        );
        $extConsumTabaco->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );

        $this->add($extConsumTabaco);



        if($param['extra-consume-alcohol']){

            $extConsumAlcoholFrec = new Select(
                'extra-consume-alcohol-frecuencia',
                [
                    'Día' => 'Día',
                    'Semana' => 'Semana',
                    'Mes' => 'Mes',
                    'Año' => 'Año',
                ]
            );
            $extConsumAlcoholFrec->addValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => CHOOSE
                        )
                    )
                )
            );

            $this->add($extConsumAlcoholFrec);
        }

        if($param['extra-consume-spa']){
            
            $extConsumSpaFrec = new Select(
                'extra-consume-spa-frecuencia',
                [
                    'Día' => 'Día',
                    'Semana' => 'Semana',
                    'Mes' => 'Mes',
                    'Año' => 'Año',
                ]
            );
            $extConsumSpaFrec->addValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => CHOOSE
                        )
                    )
                )
            );
            
            $this->add($extConsumSpaFrec);
        }

        if($param['extra-consume-tabaco']){
            
            $extConsumTabacoFrec = new Select(
                'extra-consume-tabaco-frecuencia',
                [
                    'Día' => 'Día',
                    'Semana' => 'Semana',
                    'Mes' => 'Mes',
                    'Año' => 'Año',
                ]
            );
            $extConsumTabacoFrec->addValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => CHOOSE
                        )
                    )
                )
            );
            
            $this->add($extConsumTabacoFrec);

        }



    }
}