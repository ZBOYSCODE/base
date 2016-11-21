<?php

namespace App\forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
//use Phalcon\Forms\Element\Radio;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class DermatologyForm extends BaseForm
{
    public function set($param) {
        
        parent::initialize();
        $alergias = new Select(
            'extra-alergias',
            [
                'Si' => 'Sí',
                'No' => 'No',
            ]
        );
        $alergias->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($alergias);
        if(isset($param['extra-alergias']) and $param['extra-alergias'] == 'Si')
        {
            $alergiasEsp = new Text(
                'extra-esp-alergias'
            );
            $alergiasEsp->addFilter('trim');
            $alergiasEsp->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($alergiasEsp);
        }

        $enfermedad = new Select(
            'extra-enfermedades-piel',
            [
                'Si' => 'Sí',
                'No' => 'No',
            ]
        );
        $enfermedad->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($enfermedad);
        if(isset($param['extra-enfermedades-piel']) and $param['extra-enfermedades-piel'] == 'Si')
        {
            $enfermedadEsp = new Text(
                'extra-esp-enfermedades-piel'
            );

            $enfermedadEsp->addFilter('trim');
            $enfermedadEsp->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($enfermedadEsp);
        }

        $tratamiento = new Select(
            'extra-tratamiento-actual',
            [
                'Si' => 'Sí',
                'No' => 'No',
            ]
        );
        $tratamiento->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($tratamiento);
        if(isset($param['extra-esp-tratamiento']) and $param['extra-esp-tratamiento'] == 'Si')
        {
            $tratamientoEsp = new Text(
                'extra-esp-tratamiento'
            );
            $tratamientoEsp->addFilter('trim');
            $tratamientoEsp->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($tratamientoEsp);
        }
        $dias = new Text(
            'extra-tiempo-dias'
        );
        $dias->addFilter('trim');
        $dias->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($dias);

        $semanas = new Text(
            'extra-tiempo-semanas'
        );
        $semanas->addFilter('trim');
        $semanas->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($semanas);

        $meses = new Text(
            'extra-tiempo-meses'
        );
        $meses->addFilter('trim');
        $meses->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($meses);

        $annos = new Text(
            'extra-tiempo-años'
        );
        $annos->addFilter('trim');
        $annos->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($annos);

        $evol = new Select(
            'extra-evolucion-condicion',
            [
                'Ha Disminuído' => 'Ha Disminuído',
                'Sin Cambios' => 'Sin Cambios',
                'Ha Aumentado' => 'Ha Aumentado',
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

        $tratamiento = new Select(
            'extra-tratamientos-anteriores',
            [
                'Si' => 'Sí',
                'No' => 'No',
            ]
        );
        $tratamiento->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($tratamiento);
        if(isset($param['extra-tratamientos-anteriores']) and $param['extra-tratamientos-anteriores'] == 'Si')
        {
            $tratamientoEsp = new Text(
                'extra-esp-tratamiento'
            );
            $tratamientoEsp->addFilter('trim');
            $tratamientoEsp->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($tratamientoEsp);
        }

        $familia = new Select(
            'extra-familiares-condicion',
            [
                'Si' => 'Sí',
                'No' => 'No',
            ]
        );
        $familia->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($familia);

        if(isset($param['extra-familiares-condicion']) and $param['extra-familiares-condicion'] == 'Si')
        {
            $familiaEsp = new Text(
                'extra-esp-fam-condicion'
            );
            $familiaEsp->addFilter('trim');
            $familiaEsp->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($familiaEsp);
        }

        $lesiones = new Select(
            'extra-distribusion-lesion',
            [
                'Lesión única' => 'Lesión única',
                'Aisladas en zonas de la piel, alternadas con zonas de piel sana' => 'Aisladas en zonas de la piel, alternadas con zonas de piel sana',
                'Agrupadas en zonas de la piel, alternadas con zonas de piel sana' => 'Agrupadas en zonas de la piel, alternadas con zonas de piel sana',
                'Lesiones generalizadas en toda la piel' => 'Lesiones generalizadas en toda la piel',
            ]
        );
        $lesiones->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($lesiones);

        $lesionesText = new Text(
            'extra-numero-lesion'
        );
        $lesionesText->addFilter('trim');
        $lesionesText->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $this->add($lesionesText);
    }
}