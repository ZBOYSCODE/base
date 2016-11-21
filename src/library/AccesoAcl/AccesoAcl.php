<?php
	namespace App\AccesoAcl;

	use Phalcon\Mvc\User\Component;
	use Phalcon\Mvc\Dispatcher;

	class AccesoAcl extends Component{

		private static $disp;

		public static function tieneAcceso()
		{
			# instanciamos para poder obtener los datos
			$acceso 		= new AccesoAcl();
			$rol 			= $acceso->getRol();
			$action 		= $acceso->getAction();
			$controlador 	= $acceso->getControlador();

			$permiso = \App\Models\Permiso::find(" rol_id = {$rol} AND permiso = '{$controlador}/{$action}' ")->toArray();

			if(count($permiso) > 0){
				return true;
			}

			# si no existe la variable, por defecto no tendrá acceso
			return false;
		}

		public static function tienePermiso($action, $controlador = null)
		{
			# instanciamos para poder obtener los datos
			$acceso 	= new AccesoAcl();
			$rol 		= $acceso->getRol();
			
			#obtenemos el action o metodo al que se requiere acceder
			$action = strtolower($action);

			# seteamos el controlador enviado como parametro
			if(isset($controlador)){
				$controlador = strtolower($controlador);
			}else{
				$controlador 	= $acceso->getControlador();
			}

			$permiso = \App\Models\Permiso::find(" rol_id = {$rol} AND permiso = '{$controlador}/{$action}' ")->toArray();

			if(count($permiso) > 0){
				return true;
			}
			
			# si no existe la variable, por defecto no tendrá acceso
			return false;
		}

		private function getRol()
		{
			return $this->auth->getIdentity()['roleId'];
		}

		private function getControlador()
		{
			return strtolower($this->dispatcher->getControllerName());
		}

		private function getAction()
		{
			return strtolower($this->dispatcher->getActionName());
		}

	}