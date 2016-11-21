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
class OphthalmologyrefractionForm extends BaseForm
{


    public function set($param) {

        parent::initialize();

        //Ojo Der Lejos
        $OdLEsf = new Text('extra-rec_lejos_esf_od');
        $OdLEsf->addFilter('trim');
        $OdLEsf->addFilter('float');
        $OdLEsf->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OdLEsf->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OdLEsf);

        $OdLCil = new Text('extra-rec_lejos_cil_od');
        $OdLEsf->addFilter('float');
        $OdLCil->addFilter('trim');
        $OdLCil->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OdLCil->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OdLCil);

        $OdLEje = new Text('extra-rec_lejos_eje_od');
        $OdLEje->addFilter('trim');
        $OdLEje->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OdLEje->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OdLEje);

        $OdLAg = new Text('extra-rec_agudeza_od');
        $OdLAg->addFilter('trim');
        $OdLAg->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($OdLAg);

        //Ojo izq Lejos
        $OiLEsf = new Text('extra-rec_lejos_esf_oi');
        $OiLEsf->addFilter('trim');
        $OdLEsf->addFilter('float');
        $OiLEsf->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OiLEsf->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OiLEsf);

        $OiLCil = new Text('extra-rec_lejos_cil_oi');
        $OdLEsf->addFilter('float');
        $OiLCil->addFilter('trim');
        $OiLCil->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OiLCil->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OiLCil);

        $OiLEje = new Text('extra-rec_lejos_eje_oi');
        $OiLEje->addFilter('trim');
        $OiLEje->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OiLEje->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OiLEje);

        $OiLAg = new Text('extra-rec_agudeza_oi');
        $OiLAg->addFilter('trim');
        $OiLAg->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($OiLAg);


        //Ojo Der cerca
        $OdCAd = new Text('extra-rec_adicion_od');
        $OdCAd->addFilter('trim');
        $OdCAd->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OdCAd->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OdCAd);

        $OdCEsf = new Text('extra-rec_cerca_esf_od');
        $OdCEsf->addFilter('trim');
        $OdLEsf->addFilter('float');
        $OdCEsf->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OdCEsf->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OdCEsf);

        $OdCCil = new Text('extra-rec_cerca_cil_od');
        $OdLEsf->addFilter('float');
        $OdCCil->addFilter('trim');
        $OdCCil->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OdCCil->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OdCCil);

        $OdCEje = new Text('extra-rec_cerca_eje_od');
        $OdCEje->addFilter('trim');
        $OdCEje->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OdCEje->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OdCEje);

        $OdCJ = new Text('extra-rec_j_od');
        $OdCJ->addFilter('trim');
        $OdCJ->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($OdCJ);

        //Ojo izq cerca
        $OiCAd = new Text('extra-rec_adicion_oi');
        $OiCAd->addFilter('trim');
        $OiCAd->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OiCAd->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OiCAd);

        $OiCEsf = new Text('extra-rec_cerca_esf_oi');
        $OiCEsf->addFilter('trim');
        $OdLEsf->addFilter('float');
        $OiCEsf->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OiCEsf->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OiCEsf);

        $OiCCil = new Text('extra-rec_cerca_cil_oi');
        $OdLEsf->addFilter('float');
        $OiCCil->addFilter('trim');
        $OiCCil->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OiCCil->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OiCCil);

        $OiCEje = new Text('extra-rec_cerca_eje_oi');
        $OiCEje->addFilter('trim');
        $OiCEje->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => REQUIRED
                    )
                )
            )
        );
        $OiCEje->AddValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $this->add($OiCEje);

        $OiCJ = new Text('extra-rec_j_oi');
        $OiCJ->addFilter('trim');
        $OiCJ->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($OiCJ);

        $eval = new Text(
            'status'
        );
        $eval->addValidators(
            array(
                new Numericality(
                    array(
                        'message' => NUMERIC
                    )
                )
            )
        );
        $eval->AddValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($eval);

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

        $lentes = new Select(
            'extra-lentes',
            [
                'anteojos' => 'Anteojos',
                'lentes contacto' => 'Lentes Contacto',
            ]
        );
        $lentes->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => CHOOSE
                    )
                )
            )
        );
        $this->add($lentes);




    }
}
