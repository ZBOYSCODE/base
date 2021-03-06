<?php
	namespace App\Controllers;

	use Phalcon\Mvc\Controller;
	use Phalcon\Mvc\Dispatcher;

	use App\Utilities\Utility;

	//use App\AccesoAcl\AccesoAcl;

	use Phalcon\Mvc\Model\Criteria;


	class ControllerBase extends Controller
	{

	    public function initialize() {

            $this->utility = new Utility();
            $this->view->utility = $this->utility;
        }



		public function beforeExecuteRoute(Dispatcher $dispatcher)
	    {
			//noAuth -> configuracion de controller y acciones que no tienen que pasar por la autentificacion

            $noAuth = $this->config->noAuth;
            $controller = strtolower($dispatcher->getControllerName());
            $action = strtolower($dispatcher->getActionName());




            if(!(isset($noAuth[$controller]['*']) || isset($noAuth[$controller][$action]) ) )
            {

                $identity = $this->auth->getIdentity();


                if (!is_array($identity)) {
                    $response = new \Phalcon\Http\Response();
                    $response->redirect("login");
                    $response->send();
                }
            }




            if(!$this->request->isPost()){

                # Condición que trae las sucursales y la sucursal seleccionada de la sessión
                # solo si es post, no aplica para ajax ni post.

            }






            /**
			 * Habilitar cuando tengan los permisos agregados
			 *//*
			if(isset($this->auth->getIdentity()['roleId']) && !AccesoAcl::tieneAcceso())
	    	{
	    		$response = new \Phalcon\Http\Response();
				$response->redirect("acceso/denegado");
				$response->send();
	    	}*/
		
	    }

	    public static function fromInput($dependencyInjector, $model, $data)
			{
			    $conditions = array();

			    if (count($data)) 
			    {
			        $metaData = $dependencyInjector->getShared('modelsMetadata');

			        $dataTypes = $metaData->getDataTypes($model);

			        $bind = array();

			        foreach ($data as $fieldName => $value) 
			        {
		                if (!is_null($value)) 
		                {
		                    if ($value != '') 
		                    {  
		                    	if ($dataTypes[$fieldName] == 2 || $dataTypes[$fieldName] == 6 || $dataTypes[$fieldName] == 1) 
		                        {                              
		                            $condition = $fieldName . " LIKE :" . $fieldName . ":";                             
		                            $bind[$fieldName] = '%' . $value . '%';
		                        } 
		                        //en otro caso buscamos la búsqueda exacta
		                        else 
		                        {                                
		                            $condition = $fieldName . ' = :' . $fieldName . ':';
		                            $bind[$fieldName] = $value;
		                        }
		                        
		                     	$conditions[] = $condition;
		                    }
		                }
			        }
			    }
			 
			    $criteria = new Criteria();
			    if (count($conditions)) 
			    {
			    	# como será una busqueda ocuparemos OR
			    	# en caso de ser un filtro se ocuparía AND
			        $criteria->where(join(' OR ', $conditions));
			        $criteria->bind($bind);
			    }
			    return $criteria;
			}


		/**
		 * Redirige a el home de la pagina
		 */
		public function defaultRedirect() {
			#redirigimos
			$this->response->redirect("");
			#deshabilitamos la vista para ahorrar procesamiento
			$this->view->disable();
		}

		/**
         * Redirige a una vista de not found
         */
		public function notFoundRedirect() {
		    $this->view->pick("error_pages/not_found");
        }

        /**
         * Redirige a una vista de not found
         */
        public function contextRedirect($url = null) {

            if($url == null)
                $this->defaultRedirect();

            #redirigimos
            $this->response->redirect($url);
            #deshabilitamos la vista para ahorrar procesamiento
            $this->view->disable();
        }
	}