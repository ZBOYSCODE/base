<?php

namespace App\forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
//use Phalcon\Forms\Element\Radio;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class OcularPressureForm extends BaseFormWrapper
{
    public function initialize() {


            $description = new Text(
                'description'
            );

            $description->addFilter('trim');

            $description->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($description);


            $descriptionPio = new Text(
                'extra-descripcion-pio'
            );

            $descriptionPio->addFilter('trim');

            $descriptionPio->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($descriptionPio);


            $descriptionTma = new Text(
                'extra-descripcion-tma'
            );

            $descriptionTma->addFilter('trim');

            $descriptionTma->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($descriptionTma);


            $pioOd = new Text(
                'extra-pio-od'
            );

            $pioOd->addFilter('trim');

            $pioOd->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($pioOd);


            $pioOi = new Text(
                'extra-pio-oi'
            );

            $pioOi->addFilter('trim');

            $pioOi->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($pioOi);


            $ctaOd = new Text(
                'extra-cta-od'
            );

            $ctaOd->addFilter('trim');

            $ctaOd->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($ctaOd);


            $ctaOi = new Text(
                'extra-cta-oi'
            );

            $ctaOi->addFilter('trim');

            $ctaOi->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($ctaOi);


            $tmaAcoOd = new Text(
                'extra-tma-aco-od'
            );

            $tmaAcoOd->addFilter('trim');

            $tmaAcoOd->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($tmaAcoOd);


            $tmaAcoOi = new Text(
                'extra-tma-aco-oi'
            );

            $tmaAcoOi->addFilter('trim');

            $tmaAcoOi->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($tmaAcoOi);


            $tmaSentOd = new Text(
                'extra-tma-sent-od'
            );

            $tmaSentOd->addFilter('trim');

            $tmaSentOd->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($tmaSentOd);


            $tmaSentOi = new Text(
                'extra-tma-sent-oi'
            );

            $tmaSentOi->addFilter('trim');

            $tmaSentOi->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($tmaSentOi);

            $horaExamenPio = new Text(
                'extra-hora-examen-pio'
            );

            $horaExamenPio->addFilter('trim');

            $horaExamenPio->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($horaExamenPio);

            $horaExamenTma = new Text(
                'extra-hora-examen-tma'
            );

            $horaExamenTma->addFilter('trim');

            $horaExamenTma->AddValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => REQUIRED
                        )
                    )
                )
            );
            $this->add($horaExamenTma);







            $status = new Select(
                'status',
                [
                    '1' => 'Por Defecto',
                    '2' => 'Malo',
                    '3' => 'Regular',
                    '4' => 'Bueno',
                ]
            );
            $status->addValidators(
                array(
                    new PresenceOf(
                        array(
                            'message' => CHOOSE
                        )
                    )
                )
            );

            $this->add($status);
    }
}