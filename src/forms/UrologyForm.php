<?php
/**
 * Created by PhpStorm.
 * User: Jorge Cociña
 * Date: 13-10-2016
 * Time: 12:06
 */

namespace App\forms;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
//use Phalcon\Forms\Element\Radio;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class UrologyForm extends BaseFormWrapper
{
    public function initialize()
    {


    		$extraDolorUrologico = new Select(
    			'extra-dolor-urologico',
    			[
    				'1' => 'Renal',
    				'2' => 'Ureteral',
    				'3' => 'Vesicular',
    				'4' => 'Prostático',
    				'5' => 'Uretral',
    				'6' => 'Escrotal',
    				'7' => 'Lumbar',
    			]
    		);

    		$extraDolorUrologico->addValidators(
    		    array(
    		        new PresenceOf(
    		            array(
    		                'message' => CHOOSE
    		            )
    		        )
    		    )
    		);

    	    $this->add($extraDolorUrologico);





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