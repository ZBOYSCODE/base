<?php
namespace App\library\Mifaces;

use Phalcon\Mvc\User\Component;

class Mifaces extends Component{

	private $_toRend;
	private $_toErrorForm;
    private $_toRedir;
	private $_toNewWin;
	private $_toMsg;
	private $_toDataSelect;
	private $_socket;
    private $_toDataView;
    private $_toJsonView;
    private $_toSwalRend;
    private $_toDataForm;
    private $_toRendAppend;

    public function __construct() {
		$this->newFaces();
	}

    public function newFaces() {
		$this->_toRend			= array();
		$this->_toErrorForm		= array();
		$this->_toNewWin		= null;
        $this->_toRedir			= null;
		$this->_toMsg			= array();
		$this->_toDataSelect	= array();
		$this->_socket			= array();
        $this->_toDataView      = array();
        $this->_toJsonView      = array();
        $this->_toSwalRend      = array();
        $this->_toDataForm      = array();
        $this->_toRendAppend    = array();
    }

	public function addToDataSelect($to, $data, $selected = false, $run = false){
		$this->_toDataSelect[$to]["data"]    =   $data;

        if(isset($selected) && $selected != false){
            $this->_toDataSelect[$to]["selected"]    =   $selected;
        }

        if($run){
            $outputs[] = array('type' => 'dataSelect', 'renders' => $this->_toDataSelect);
            echo json_encode($outputs);
            exit();
        }
	}

	public function addToMsg($type, $msg, $run = false){
		$this->_toMsg[$type]=$msg;
		if($run){
			$outputs[] = array('type' => 'msg',		'msgs'		=> $this->_toMsg );
			echo json_encode($outputs);
			exit();
		}

	}

	public function addNewWin($htmlString, $name, $run = false){
		if($name!=null && $htmlString!=null){
			$this->_toNewWin['name']=$name;
			$this->_toNewWin['htmlString']=$htmlString;
			
			if($run){
				$outputs[] = array('type' => 'newWin', 'win' =>$this->_toNewWin['htmlString'], 'name'=>$this->_toNewWin['name']);
				echo json_encode($outputs);			
			}			
		}
	}

    public function addRedir($url, $run = false){
        if($url!=null){
            $this->_toRedir=$url;
            if($run){
                $outputs[] = array('type' => 'redir', 'redir'=>$url);
                echo json_encode($outputs);
            }
        }
    }

	public function addSocket($jquery){
		$this->_socket[]=$jquery;
	}
	
	public function addToRend($div,$htmlString, $run = false){
		$this->_toRend[$div]=$htmlString;
		if($run){
			$outputs[] = array('type' => 'render',	'renders'	=> $this->_toRend );
			echo json_encode($outputs);
			exit();
		}
	}

    public function addToRendAppend($div,$htmlString, $run = false){
        $this->_toRendAppend[$div]=$htmlString;
        if($run){
            $outputs[] = array('type' => 'renderappend',	'renders'	=> $this->_toRendAppend );
            echo json_encode($outputs);
            exit();
        }
    }

	public function addErrorsForm($arreglo, $run = false){

		if($arreglo != null && $arreglo != ''){			
			$this->_toErrorForm = $arreglo;	
		}
		if($run){
			$outputs[] = array('type' => 'errorForm', 'data' => $this->_toErrorForm);
			echo json_encode($outputs);
			exit();
		}		
	}

	public function addToDataView($key, $data, $run = false){
	    if($key != null && $data != null && $key != '' && $data != '') {
	           $this->_toDataView[$key] = $data;
        }
        if($run) {
            $outputs[] = array('type' => 'data', 'dataview' => $this->_toDataView);
            echo json_encode($outputs);
            exit();
        }
    }

    public function addToJsonView($key, $array, $run = false) {


        if($key != null && $array != null && $key != '' && $array != '') {
            $this->_toJsonView[$key] = $array;
        }
        if($run) {
            $outputs[] = array('type' => 'json', 'datajson' => $this->_toJsonView);
            echo json_encode($outputs);
            exit();
        }

    }

    public function addToSwalRend($config, $htmlString, $run = false) {

        $this->_toSwalRend[$config["type"]]["html"] = $htmlString;
        $this->_toSwalRend[$config["type"]]["config"] = $config;

        if($run){
            $outputs[] = array('type' => 'swal',	'renders'	=> $this->_toSwalRend );
            echo json_encode($outputs);
            exit();
        }
    }

    public function addToFormData($arreglo, $run = false) {
        if($arreglo != null && $arreglo != ''){
            $this->_toDataForm = $arreglo;
        }
        if($run){
            $outputs[] = array('type' => 'dataForm', 'data' => $this->_toDataForm);
            echo json_encode($outputs);
            exit();
        }
    }

	public function run(){

		$outputs = array();
	

		if(count($this->_toRend)>0)
			$outputs[] = array('type' => 'render',	'renders'	=> $this->_toRend );

        if(count($this->_toRendAppend)>0)
            $outputs[] = array('type' => 'renderappend',	'renders'	=> $this->_toRendAppend );

        if($this->_toRedir!=null)
            $outputs[] = array('type' => 'redir',	'redir'		=> $this->_toRedir );

		if(count($this->_socket)>0)
			$outputs[] = array('type' => 'socket',	'sockets'		=> $this->_socket );			
		
		if($this->_toNewWin!=null)
			$outputs[] = array('type' => 'newWin', 	'win'		=> $this->_toNewWin['htmlString'], 'name' => $this->_toNewWin['name']);

		if(count($this->_toMsg)>0)
			$outputs[] = array('type' => 'msg',		'msgs'		=> $this->_toMsg );

		if(count($this->_toDataSelect)>0){
            $outputs[] = array('type' => 'dataSelect', 'renders' => $this->_toDataSelect);
		}

		if(count($this->_toDataView)>0) {
		    $outputs[] = array('type' => 'data',    'dataview'  => $this->_toDataView);
        }

        if(count($this->_toJsonView) > 0){
            $outputs[] = array('type' => 'json', 'datajson' => $this->_toJsonView);
        }

        if(count($this->_toSwalRend)>0) {
            $outputs[] = array('type' => 'swal',	'renders'	=> $this->_toSwalRend );
        }

        if(count($this->_toErrorForm)>0){
        	$outputs[] = array('type' => 'errorForm', 'data' => $this->_toErrorForm);
        }

        if(count($this->_toDataForm) > 0) {
            $outputs[] = array('type' => 'dataForm', 'data' => $this->_toDataForm);
        }
        

		echo json_encode($outputs);
	}
}
