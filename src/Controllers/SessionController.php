<?php

namespace App\Controllers;

use App\Models\Users;
use App\library\Valida\Valida;
use App\Business\UserBSN;

class SessionController extends ControllerBase
{


    public function initialize()
    {
        $this->view->setVar("displayNav", false);
    }

    public function loginAction() {

        $vars = $this->session->get('auth-identity');

        if (isset($vars['id'])) {

            return $this->response->redirect('');

        } else {

            $this->assets->addJs("js/pages/login.js");
            $this->view->pick("controllers/session/_index");

        }


        	

    }

    /**
     * Logín de usuario
	 *
     * Verifica que las credenciales sean validas y retorna un json
     * con el cual verificamos si success es true o false
     * en caso de tener una respuesta false, retornamos también msg
     * que contiene el/los mensaje de error
     * 
     * @param string $email correo o nombre de usuario
     * @param string $password contraseña
     * @param boolean $remember
     *
     * @return boolean
     */
    public function loginUserAction() {

		if( !$this->request->isAjax() ) {
			return false;
		}

    	/*	Ejemplo

    		$_post = array(
    			'email' => "sebasilvac88@gmail.com",
      			'password' => "admin",
      			'remember' => true
      		);
      	*/


        $this->valida->validate($_POST, [
            'email'  => "required|string",
            'password'   => "required|string|min:1"
        ]);

        $this->valida->getErrors();

        if ( $this->valida->failed() ) {

            $arr = array();

            foreach ($this->valida->getErrors() as $campo => $error) {

                $arr[] = "Error en el campo '{$campo}': {$error}";
            }

            $data['success'] = false;
            $data['msg'] = $arr;
            
        } else {

            //if ( $this->security->checkToken() ) {
            if(true){
                // The token is OK
            
                try {

                    if ( $this->auth->check($_POST) !== false ) {

                        $data['msg'][] = "Usuario logeado";
                        $data['success'] = true;
                        $data['redirect'] = $this->url->get('');
                    }

                } catch (\Exception $e) {

                    $data['msg'][] = $e->getMessage();
                    $data['success'] = false; 
                }


            } else {

                $data['msg'][] = "Error de validación, por favor recarge la página";
                $data['success'] = false; 

            }

		}

    	echo json_encode($data, JSON_PRETTY_PRINT);
    }

    /**
     * Logout de usuario
	 *
     * cierra la sesión
     * 
     *
     * @return boolean
     */
    public function logoutAction() {

    	$this->auth->remove();
        $this->session->destroy();

        return $this->response->redirect('login');

    }

    /**
     * getavatarAction
     *
     * @author Hernan Feliú
     *
     * Método para mostrar foto de usuario en Login.
     * @return json 
     *
     */

    public function getavatarAction(){
       
        if($this->request->isAjax()){
            $post = $this->request->getPost();

            $userObj = new UserBSN();

            $email = $post["email"];
                  
            $data["avatar"] = $userObj->getAvatarUser($email);

            echo json_encode($data, JSON_PRETTY_PRINT);
                
          }else{

                $this->defaultRedirect();
          }
    }
}
