<?php
namespace App\Controllers;
use Phalcon\Mvc\View\Engine\Volt\Compiler as VoltCompiler;
use App\Business\UserBSN;

define('BASE_LOCATION', 'pic/avatars/');
class ProfileController extends ControllerBase
{

    private $userBsn;

    public function initialize(){
        parent::initialize();
        $this->userBsn = new UserBSN();
    }

    public function indexAction() {
        $this->assets->addJs('js/pages/profile.js');
        $this->assets->addJs('js/plugins/cropimg.js');
        $this->assets->addCss('css/pages/profile/component.css');
        $this->assets->addCss('css/pages/profile/demo.css');
        $user = $this->userBsn->show(array('id' => $this->session->get("auth-identity")['id']));
        $details = $this->userBsn->getUserDetailsById($user->id);

        $this->view->setVar('details', $details);
        $this->view->setVar('user', $user);
        $this->view->setVar('avatar', $user->avatar);

        $this->view->pick('controllers/profile/index');
    }

    public function changePasswordAction() {
        if ($this->request->isAjax()) {
            $this->mifaces->newFaces();
            $this->valida->validate($_POST, [
                'password-actual'    => "required",
                'password-nueva'     => "required|min:8",
                'password-nueva-ext' => "required|min:8"
                ]);

            $this->valida->getErrors();

            if ( $this->valida->failed() ) {

                $arr = array();

                foreach ($this->valida->getErrors() as $campo => $error) {
                    $arr[] = array($campo, $error);
                }

                $this->mifaces->addErrorsForm( $arr );
                $this->mifaces->addToDataView('errorform', 'true', false );
                $this->mifaces->run();
                exit();
            } else if ($_POST['password-nueva-ext'] !=  $_POST['password-nueva']) {

                $this->mifaces->addToMsg('danger', 'Las contraseñas no coinciden');

            } else {

                if($this->userBsn->changePassword(
                    array(
                        'password' => $_POST['password-actual'],
                        'password-nueva' => $_POST['password-nueva']
                        )
                    )
                    ){

                    $this->mifaces->addToMsg('success', 'Contraseña modificada correctamente');
                $this->mifaces->addToDataView('errorform', 'false', false );
            } else {
                $msg = '';
                foreach ($this->userBsn->error as $error) {
                    $msg = $msg . $error . '.<br>';
                }
                $this->mifaces->addToMsg('danger', $msg);
                $this->mifaces->addToDataView('errorform', 'true', false );
            }

        }
        $this->mifaces->run();
    }
    else {
        $this->defaultRedirect();
    }
}

public function changeavatarAction() {
    if ($this->request->isAjax()) {
        $this->mifaces->newFaces();

        if ($this->request->hasFiles() == true) {

            $files = $this->request->getUploadedFiles();

            foreach ($files as $file_name => $file) {

                if(isset($file)){
                    if(strpos($file->getRealType(), 'image') !== false) {

                        $user = $this->userBsn->show(array('id' => $this->session->get("auth-identity")['id']));

                        if ($user->avatar == "pic/avatar/default.png"){

                            $name = BASE_LOCATION . date('Y_m_d-H_i_s') . $file->getName();

                        }
                        else{
                             $name = $user->avatar;
                        }
                        //echo $name;exit;
                        if(!$file->moveTo($name))
                            $this->mifaces->addToMsg('danger',"Error al subir la imagen, repita el procedimiento",true);


                        if($this->userBsn->changeAvatar(array('imgdir'=> $name))) {
                            $this->mifaces->addToMsg('success', 'Avatar correcto, porfavor corte imagen.');
                            $this->mifaces->addToDataView('errorform', 'false', false );       

                            $dataView['avatar'] = $this->di->get('url')->getBaseUri() . $user->avatar;
                            $toRend = $this->view->getPartial("controllers/profile/avatar_change/modal_resize", $dataView);

                            $this->mifaces->addToRend('modal-inner-content', $toRend);
                        } else {
                            $msg = '';
                            foreach ($this->userBsn->error as $error) {
                                $msg = $msg . $error . '.<br>';
                            }
                            $this->mifaces->addToMsg('danger', $msg);
                            $this->mifaces->addToDataView('errorform', 'true', false);
                        }

                    } else {
                        $this->mifaces->addToMsg('danger','El archivo debe ser una imagen ');
                        $this->mifaces->addToDataView('errorform', 'true', false);
                    }


                }
            }
        } else {
            $this->mifaces->addToMsg('danger','Tiene que seleccionar un archivo');
        }

        $this->mifaces->run();
    }
    else {
        $this->defaultRedirect();
    }
}

public function uploadavatarAction() {
    if ($this->request->isAjax()) {
        if ($this->request->hasFiles() == true) {

            $files = $this->request->getUploadedFiles();
            $view = "controllers/profile/avatar";
            $view_modal = "controllers/profile/avatar_change/modal";

            foreach ($files as $file_name => $file) {

                if(isset($file)){
                    if(strpos($file->getRealType(), 'image') !== false) {

                        $param = [
                        'id' => $this->session->get("auth-identity")['id']
                        ];

                        $user = $this->userBsn->show($param);

                        $file->moveTo($user->avatar);




                        $details = $this->userBsn->getUserDetailsById($user->id);

                        $dataView['details'] = $details;
                        $dataView['avatar'] =  $user->avatar;


                        $toRend = $this->view->getPartial($view, $dataView);

                        $toRendModal = $this->view->getPartial($view_modal, []);

                        $this->mifaces->addToRend('avatar_render', $toRend);
                        $this->mifaces->addToRend('modal-chav', $toRendModal);


                        $this->mifaces->addToMsg('success', 'Avatar modificado correctamente');
                        $this->mifaces->addToDataView('croperror', 'false', false );


                    } else {
                        $this->mifaces->addToMsg('danger','El archivo debe ser una imagen ');
                        $this->mifaces->addToDataView('croperror', 'true', false);
                    }


                }
            }
        } else {
            $this->mifaces->addToMsg('danger','Tiene que seleccionar un archivo');
        }

        $this->mifaces->run();
    }
    else{
        $this->defaultRedirect();
    }
}
}