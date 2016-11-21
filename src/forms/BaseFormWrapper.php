<?php
namespace App\forms;
use Phalcon\Forms\Form;

define('NUMERIC', 'El campo debe ser un número');
define('REQUIRED', 'El campo es requerido');
define('CHOOSE', 'Se debe seleccionar una opción');

class BaseFormWrapper extends Form
{
    private $errorMessages = array();

    public function formatMessages(){

        #Obtenemos los mensajes del formulario instanciado
        $messages = $this->getMessages();
        $_messagesTmp = array();

        #transformamos de la forma array[field] = messsage
        foreach($messages as $message){
            $_messagesTmp[] = array(
                $message->getField(),
                $message->getMessage()
            );
        }

        $this->errorMessages = $_messagesTmp;

    }

    /**
     * @return array
     */
    public function getErrorMessages()
    {
        return $this->errorMessages;
    }

    /**
     * @param array $errorMessages
     */
    public function setErrorMessages($errorMessages)
    {
        $this->errorMessages = $errorMessages;
    }
}