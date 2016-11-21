<?php
	namespace App\library\Valida;

	use Phalcon\Mvc\User\Component;
	use Phalcon\Mvc\Dispatcher;

	class Valida extends Component{

		public 	$post;
		private $failed = false;
		private $list_errors;

		private $rules = array(	'required',
								'int',
								'string',
								'max',
								'min',
								'email',
								'date',
								'rut',
                                'time'
								);


		public function validate($post, $reglas) {

			// reset variables
			$this->failed 		= false;
			$this->list_errors 	= null;


			# verificamos que la variable $arg sea un array
			if( is_array($post) ) {

				$this->setPost($post);

				# recorremos el array
				foreach ($reglas as $campo => $regla) {
					
					$this->isValid($campo, $regla);
				}

			} else {
				# en caso de no ser un array retornamos un false
				$this->list_errors[] = "El primer argumento debe ser un array";
				return false;
			}
		}

		private function setPost($post){
			$this->post = $post;
		}


		private function isValid($campo, $reglas)
		{
			$reglas = explode('|', $reglas);

			// dejamos en una variable si es entero o no
			if(in_array('int', $reglas)){
				$entero = true;
			} else {
				$entero = false;
			}

			foreach ($reglas as $regla) {
				# buscamos el : para saber si es max o min
				$pos = strpos($regla, ':');


				if($pos === false){# si no se encuentra el :

					if(in_array($regla, $this->rules)) {

						$regla = "is_".$regla;
						if(!$this->$regla($campo)){
							$this->failed = true;
						}

					} else {
						$this->list_errors[] = "El tipo de regla no existe.";
					}
				
				} else {
					# separamos la regla del valor
					$regla = explode(':', $regla);


					if(in_array($regla[0], $this->rules)) {

						$r = "is_".$regla[0];
						if(!$this->$r($campo, $regla[1], $entero)){
							$this->failed = true;
						}

					} else {
						$this->list_errors[] = "El tipo de regla no existe.";
					}
				}
			}

		}

		private function is_required($campo) {

			if(isset($this->post[$campo])){

				if(empty($this->post[$campo])){
					$this->list_errors[$campo] = "Campo requerido.";
					return false;
				}

			} else {
				$this->list_errors[$campo] = "Campo requerido.";
				return false;
			}

			return true;
		}

		private function is_string($campo) {

			if(!is_string($this->post[$campo])) {

				if( !isset($this->list_errors[$campo]) ) {

					$this->list_errors[$campo] = "Este campo debe ser un texto.";
				}
				

				return false;
			}

			return true;
		}

		private function is_int($campo) {

			if(isset($this->post[$campo])){

				if(!is_int( (int)$this->post[$campo] )) {

					if( !isset($this->list_errors[$campo]) ) {

						$this->list_errors[$campo] = "Este campo debe ser un entero.";
					}

					return false;
				}

			}
			
			return true;
		}

		private function is_email($campo) {
			
			if(isset($this->post[$campo])){
				if (!filter_var($this->post[$campo], FILTER_VALIDATE_EMAIL)) {

					if( !isset($this->list_errors[$campo]) ) {
				    	
				    	$this->list_errors[$campo] = "Debe ingresar un email válido.";
				    }

					return false;
				}
			}
			return true;
		}

		private function is_max($campo, $num, $tipo) {

			if(isset($this->post[$campo])) {

				if($tipo) {

					if($this->post[$campo] > $num) {

						if( !isset($this->list_errors[$campo]) ) {

							$this->list_errors[$campo] = "Este valor debe ser menor o igual a {$num}.";
						}

						return false;
					}

				} else {
					if(mb_strlen($this->post[$campo]) > $num) {

						if( !isset($this->list_errors[$campo]) ) {
							
							$this->list_errors[$campo] = "El número de caracteres de este campo debe ser menor o igual a {$num}.";
						}

						return false;
					}
				}
			}
			
			return true;		
		}

		private function is_min($campo, $num, $tipo) {
			
			if(isset($this->post[$campo])){

				if($tipo){

					if($this->post[$campo] < $num) {

						if( !isset($this->list_errors[$campo]) ) {
							
							$this->list_errors[$campo] = "Este valor debe ser mayor o igual a {$num}.";
						}

						return false;
					}
					
				} else {

					if(mb_strlen($this->post[$campo]) < $num) {

						if( !isset($this->list_errors[$campo]) ) {
							
							$this->list_errors[$campo] = "El número de caracteres de este campo debe ser mayor o igual a {$num}.";
						}

						return false;
					}
				}
			}
			
			return true;
		}

		private function is_date($campo) {

			if(isset($this->post[$campo]) && !empty($this->post[$campo])){

				if(!$this->validateDate($this->post[$campo])) {

					if( !isset($this->list_errors[$campo]) ) {
							
						$this->list_errors[$campo] = "Debe ingresar una fecha válida.";
					}

					return false;
				}
			}

			return true;
		}

		private function validateDate($date, $format = 'Y-m-d') {

		    $d = \DateTime::createFromFormat($format, $date);
		    return $d && $d->format($format) == $date;
		}

		private function is_time($campo){
            if(isset($this->post[$campo]) && !empty($this->post[$campo])){

                if(!$this->validateTime($this->post[$campo])) {

                    if( !isset($this->list_errors[$campo]) ) {

                        $this->list_errors[$campo] = "Debe ingresar una hora válida.";
                    }

                    return false;
                }
            }

            return true;
        }

        private function validateTime($myTime) {
            $time = preg_match('#^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$#', $myTime);

            if ( $time == 1 )
            {
                return true;
            }
            else
            {
                return false;
            }
        }

		private function is_rut($campo) {

			if(isset($this->post[$campo]) && !empty($this->post[$campo])){

				if(!$this->valida_rut($this->post[$campo])) {

					if( !isset($this->list_errors[$campo]) ) {
							
						$this->list_errors[$campo] = "Debe ingresar un rut valido.";
					}

					return false;
				}
			}

			return true;
		}

		private function valida_rut($rut)
		{
		    if (!preg_match("/^[0-9.]+[-]?+[0-9kK]{1}/", $rut)) {
		        return false;
		    }

		    $rut 	= preg_replace('/[\.\-]/i', '', $rut);
		    $dv 	= substr($rut, -1);
		    $numero = substr($rut, 0, strlen($rut) - 1);
		    $i 		= 2;
		    $suma 	= 0;
		    
		    foreach (array_reverse(str_split($numero)) as $v) {
		        if ($i == 8)
		            $i = 2;
		        $suma += $v * $i;
		        ++$i;
		    }
		    
		    $dvr = 11 - ($suma % 11);
		    
		    if ($dvr == 11)
		        $dvr = 0;
		    if ($dvr == 10)
		        $dvr = 'K';
		    if ($dvr == strtoupper($dv))
		        return true;
		    else
		        return false;
		}
	

		public function failed(){
			return $this->failed;
		}

		public function getErrors(){
			return $this->list_errors;
		}


	}