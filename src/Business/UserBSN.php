<?php

namespace App\Business;

use App\Models\Users;
use App\Models\UserDetails;
use App\Models\Roles;
use App\Models\MedicalPlan;
use App\Models\UsersSpecialtiesBranchoffices;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Specialties;

use Phalcon\Mvc\User\Plugin;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

use App\library\Valida\Valida;

/*
 * Limite por defecto a los elementos por pagina
 */
define("DEFAULT_PAGE_LIMIT", 10);

/**
 * Clase diseñada para realizar consultas sobre Users y UserDetails
 *
 * @author      jcocina
 *
 */
class UserBSN extends Plugin
{
    public $error = array();
    /**
     * Obtiene la lista de los usuarios con su informacion, puede ser entregada
     * paginada o sin paginar
     *
     * Para paginacion revisar:
     * https://docs.phalconphp.com/es/latest/api/Phalcon_Paginator_Adapter_Model.html
     *
     * @author      jcocina
     * @param   array   $param
     *                      'pagination'    bool    determina si el resultado se
     *                                              debe paginar
     *                      'limit'         int     es la cantidad de elementos
     *                                              por pagina, si no se envia
     *                                              se toma el por defecto
     *                      'page'          int     es la pagina que debe ser
     *                                              retornada, si no se envia
     *                                              por defecto es 1
     *                      'role'          int     id del Rol de la lista de
     *                                              usuarios
     *                                              de no ser especificado se
     *                                              traen todos
     *
     * @return  array   la lista de Users con sus UserDetails
     */
    public function index($param)
    {
        extract($param);

        $where = " WHERE 1=1 ";

        $query = "SELECT u.id, email, firstname, lastname, rut,
                  username, avatar, name as role, active, suspended, banned, location, phone_fixed, phone_mobile, medical_plan_id
                  FROM App\Models\Users u
                  LEFT JOIN App\Models\UserDetails ud ON u.id = ud.user_id ";

        if (isset($role)) {
            $query = $query . ' JOIN App\Models\Roles r
                    ON u.role_id = r.id';

            $where .= ' AND r.id = "' . $role . '" ';
        }

        if(isset($search)) {

            $where .= " AND (firstname like '%{$search}%' ";
            $where .= " OR lastname like '%{$search}%' ";
            $where .= " OR email like '%{$search}%' ";
            $where .= " OR username like '%{$search}%' ";
            $where .= " OR rut like '%{$search}%' ) ";

        }


        $result = $this->modelsManager->createQuery($query.$where)
            ->execute();

        if($result->count() > 0){
            // Paginación
            if (isset($pagination) and $pagination) {
                if (!isset($limit))
                {
                    $limit = DEFAULT_PAGE_LIMIT;
                }
                if (!isset($page))
                {
                    $page = 1;
                }
                $paginator = new PaginatorModel(
                        array(
                            'data' => $result,
                            'limit' => $limit,
                            'page' => $page
                        )
                    );
                return $paginator->getPaginate();
            }
            else {
                return $result;
            }
        } else{
            $this->error[] = $this->errors->NO_RECORDS_FOUND;
            return false;
        }
    }

    /**
     * Obtiene el primer usuario que se corresponda con los parametros
     * entregados
     *
     * @author  jcocina
     * @param   array   $param
     *                      'id'        int    Id del uauario que se desea
     *                                         encontrar
     *                      'username'  String username o email del usuario
     * Ambos parametros no deben ser nulos
     *
     * @return  Users   Usuario con la correspondencia
     *          null    En caso de error
     */
    public function show($param){

        extract($param);

        if(!isset($id) AND
           !isset($username)){

            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }

        if(isset($id))
            $result = Users::findFirstById($id);
        elseif(isset($username))
            $result = Users::findFirstByUsername($username);


        /*

        $result = Users::query()
            ->leftjoin('App\Models\UserDetails')
            ->where('1 = 1');

        if (isset($id))
        {
            $result = $result
                ->andwhere(
                    'App\Models\Users.id = :id:',
                    array('id' => $id)
                );
        }

        if (isset($username))
        {
           $result = $result
               ->andwhere(
                    'username = :username: or email = :email:',
                    array('username' => $username, 'email' => $username)
                );
        }

        $result = $result
            ->execute();
            */
        if($result != false)
            return $result;
        else{
            $this->error[] = $this->errors->NO_RECORDS_FOUND;
            return false;
        }
    }

    /**
     * Seba
     */
    public function getUserById($id) {

        return Users::findFirstById($id);

    }

    public function getUserDetailsById($id){
        if(!isset($id)){
            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }
        return UserDetails::findFirst('user_id =' . $id);
    }

    /**
     * Actualiza los datos detalle de un usuario
     *
     * @author osanmartin
     * @param array param
     *          (
     *              int     id
     *              String  firstname
     *              String  lastname
     *              String  rut
     *              String  location
     *              String  phone_fixed
     *              String  phone_mobile
     *          )
     * @return true     en caso de que el update sea correcto
     *         false    en caso de error
     */
    public function editUserDetails($param){
        // CASO 1: Si $param es un objeto

        if(is_object($param)){
            $userDetails = $param;
            if (strpos(get_class($userDetails), 'UserDetails')){

                if ($userDetails->save() == false)
                {
                    foreach ($userDetails->getMessages() as $message) {
                        $this->error[] = $message->getMessage();
                    }
                    return false;
                } else{
                    return true;
                }
            }
        }


        // CASO 2: $param es un array

        if(!isset($param['user_id'])){
            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }

        $user = UserDetails::findFirstByUserId($param['user_id']);

        if(!$user){
            $this->error[] = $this->errors->NO_RECORDS_FOUND_ID;
            return false;
        }

        foreach ($param as $key => $val) {
            $user->$key = $val;
        }

        if ($user->save() == false)
        {
            foreach ($user->getMessages() as $message) {
                $this->error[] = $message->getMessage();
            }
        } else{
            return true;
        }
    }


    /**
     * Actualiza los datos de un usuario
     *
     * @author osanmartin
     * @param array $param atributos de usuario
     * @param object $param objeto Users
     *
     * @return true     en caso de que el update sea correcto
     *         false    en caso de error
     */
    public function editUser($param){
        // CASO 1: Si $param es un objeto
        if(is_object($param)){
            $users = $param;
            if (strpos(get_class($users), 'Users')){

                if ($users->save() == false)
                {
                    foreach ($users->getMessages() as $message) {
                        $this->error[] = $message->getMessage();
                    }
                    return false;
                } else{
                    return true;
                }
            }
        }


        // CASO 2: $param es un array
        if(!isset($param['id'])){

            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }



        $user = Users::findFirstById($param['id']);

        #si viene un solo parametro ($param['user_id']) no hay que cambiar nada por tanto no se updatea y retornamos true
        if(count($param) == 1)
        {
            return true;
        }

        if(!$user->count()){
            $this->error[] = $this->errors->NO_RECORDS_FOUND_ID;
            return false;
        }


        foreach ($param as $key => $val) {
            if ($key == 'password') {
                if (!empty($val)) {
                    $user->$key = $this->getDI()
                        ->getSecurity()
                        ->hash($val);
                }

            } else {
                $user->$key = $val;
            }

        }



        if ($user->save() == false)
        {
            foreach ($user->getMessages() as $message) {
                $this->error[] = $message->getMessage();
            }
        } else{

            return true;
        }
    }

    /**
    * editUserPassAvatar
    *
    *   @param array $param[
    *   
    *                                ]
    *
    *
    *
    *
    */

    /******* NO SUBIR COSAS CON ERRORES!!
    public function editUserPassAvatar($param){

        #Full Method
        if(isset($param['user_id']) AND !empty($param['user_id']) AND
           isset($param['new_password']) AND !empty($param['new_password']) AND
           isset($param['old_password']) AND !empty($param['old_password']) AND
           isset($param['avatar_string']) AND !empty($param['avatar_string']))
        {

        $user = Users::findFirstById($param['user_id']);
        $old_password = $param['old_password'];
        $new_password = $param['new_password'];


        if($this->security->checkHash($old_password, $user->password){


            echo $new_password;
        }else{
            $this->error = $this->errors->
        }   


        }

        #Only_New_password
        elseif(isset($param['user_id']) AND !empty($param['user_id']) AND
               isset($param['new_password']) AND !empty($param['new_password']) AND
               isset($param['old_password']) AND !empty($param['old_password']) AND)
        {


        }

        #Only_Avatar
        elseif(isset($param['user_id']) AND !empty($param['user_id']) AND
           isset($param['avatar_string']) AND !empty($param['avatar_string']))
        {

        }
        else{

            $this->error = $this->errors->MISSING_PARAMETERS;
            return false;

        }


    }
     ****/





    /**
     * getListSpecialistUSB
     *
     * Obtiene objetos USB que permiten acceder a especialistas
     *
     * @author osanmartin
     *
     * @param integer $data['branchOffice_id'] : id de la sucursal seleccionada
     * @param integer $data['specialty_id'] : id de la especialidad seleccionada
     *
     *
     * @return objectList lista de objetos USB si es exitoso
     *         boolean    false    en caso de error
     */



    /**
     * crea usuario
     *
     * @author ssilvac
     * @param array $param
     * @return integer $id
     */
    public function createUser($param) {


        if( isset($param['id']) and !empty($param['id']) ){

            $user = Users::findFirstById($param['id']);

        } else {
            $user = new Users();
        }

        if (isset($param['username'])) {
            $user->username = $param['username'];
        } else {
            $this->error[] = $this->error->MISSING_PARAMETERS;
            return false;
        }

        if (isset($param['email'])) {
            $user->email = $param['email'];
        } else {
            $this->error[] = $this->error->MISSING_PARAMETERS;
            return false;
        }

        if (isset($param['avatar'])) {
            $user->avatar = $param['avatar'];
        } else {
            $user->avatar = '';
        }

        if (isset($param['password'])) {
            $user->password = $param['password'];
        } else {
            $user->password = '';
        }

        if (isset($param['banned'])) {
            $user->banned = $param['banned'];
        } else {
            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }

        if (isset($param['suspended'])) {
            $user->suspended = $param['suspended'];
        } else {
            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }

        if (isset($param['active'])) {
            $user->active = $param['active'];
        } else {
            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }

        if (isset($param['role_id'])) {
            $user->role_id = $param['role_id'];
        } else {
            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }

        if($user->save() == false)
        {
            foreach ($user->getMessages() as $message) {

                $this->error[] = $message->getMessage();
            }

            return false;

        } else {
            return $user->id;
        }
    }

    /**
     * crea detalle usuario
     *
     * @author ssilvac
     * @param array $param
     * @return integer $id
     */
    public function createUserDetail($param) {


        #solo si viene el rut se verifica que existe, si no es un paciente sin rut.
        if(isset($param["rut"]) && $this->existsRut( $param ) ){

            $this->error[] = 'El rut ya se encuentra registrado.';
            return false;
        }


        if( isset($param['id']) and !empty($param['id']) ){

            $user = UserDetails::findFirstByUserId($param['id']);

        } else {
            $user = new UserDetails();
        }


        foreach ($param as $key => $val) {
            $user->$key = $val;
        }

        try {

            if($user->save() == false)
            {
                foreach ($user->getMessages() as $message) {

                    $this->error[] = $message->getMessage();
                }

                return false;

            } else {
                return $user->user_id;
            }

        } catch (Exception $e) {

            $this->error[] = "Problemas en la Base de datos";
            return false;
        }




    }

    /**
     * Elimina un usuario
     *
     * @author ssilvac
     * @param $param['id']: ID de user
     *
     * @return boolean: true, si fue eliminado correctamente
     */
    public function deleteUser($param) {

        if(!isset($param['id'])) {
            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }

        $user = Users::findFirstById($param['id']);

        if(!$user->count()){
            $this->error[] = $this->errors->NO_RECORDS_FOUND_ID;
            return false;
        }

        $user->active = 'N';

        if($user->update() == false)
        {
            foreach ($user->getMessages() as $message) {

                $this->error[] = $message->getMessage();
            }

            return false;

       } else {
           return true;
       }
    }

    /**
     * Verifica que un email ya fue utilizado
     *
     * @author osanmartin
     * @param array param['user_id'] : ID de User
     * @param array param['email'] : Email a elegir
     * @return true Si no hay conflicto
     *         false Si hay conflicto o error
     */

    public function isConflictEmail($param){


        if(!isset($param['email'])){

            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;

        }
        else {

            #no existe correo
            if($this->existsEmail($param) == false){
                return true;
            }
            #existe correo
            else {

                if(isset($param["user_id"])){
                    $user = Users::findFirst("email = '{$param['email']}'");

                    #soy yo y es mi email
                    if($user->id == $param["user_id"] and $user->email == $param['email'])
                    {
                        return true;
                    }
                    #soy yo y no es mi email
                    else if($user->id == $param["user_id"] and $user->email != $param['email'])
                    {

                        return false;
                    }
                    else{
                        #metodo de escape control
                        $this->error[] = $this->errors->CONSISTENCE_ERROR;

                        return false;
                    }
                }
                #creando usuario y alguien tiene ese correo tomado
                else{
                    return false;

                }

            }

        }

    }

    /**
     * Verifica que existe un email
     *
     * @author osanmartin
     * @param array param['email'] : Email a elegir
     * @return true    en caso de que el email exista
     *         false    en caso de que no exista
     */
    public function existsEmail($param){
        if(!isset($param['email'])){
            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }

        $result = Users::findFirst("email = '{$param['email']}'");


        if(!$result)
            return false;
        else
            return true;
    }


    /**
     * Verifica que existe un rut
     *
     * @author Sebastián Silva
     *
     * @param array $param
     * @return boolean
     */
    public function existsRut($param){


        if(!isset($param['rut'])) {
            return true;//
        }


        $result = UserDetails::findFirst("rut = '{$param['rut']}'");

        #verificamos si es el mismo usuario con rut igual, significa que no se repite por que es del propio
        # este caso se da cuando estamos editando.

        if(isset($param["user_id"])){
            #si el id es igual al id enviado
            if($result and $result->Users->id == $param["user_id"]){
                return false;
            }
        }

        if(!$result)
            return false;
        else
            return true;
    }


    /**
     * Verifica que un username ya fue utilizado
     *
     * @author osanmartin
     * @param array param['user_id'] : ID de User
     * @param array param['username'] : Email a elegir
     * @return true Si no hay conflicto
     *         false Si hay conflicto o error
     */

    public function isConflictUsername($param){

        // Usuario existente
        if(isset($param['user_id']) AND !empty($param['user_id'])){
            if(!isset($param['username'])){
                $this->error[] = $this->errors->MISSING_PARAMETERS;
                return false;
            }else {
                $user = Users::findFirstById($param['user_id']);
                if($user){
                    $result = $this->existsEmail($param);

                    if($result AND $user->username != $param['username']){
                        $this->error[] = $this->errors->USERNAME_EXISTS;
                        return false;
                    }
                }
            }
        }
        // Usuario no existente
        else{
            if(isset($param['username'])){
                $result = $this->existsEmail($param);
                // Si el username existe, retorno false, eso implica que sí hay conflicto
                if($result){
                    $this->error[] = $this->errors->USERNAME_EXISTS;
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Verifica que existe un username
     *
     * @author osanmartin
     * @param array param['username'] : username a elegir
     * @return true    en caso de que el username exista
     *         false    en caso de que no exista
     */
    public function existsUsername($param){
        if(!isset($param['username'])){
            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }

        $result = Users::findFirst("username = '{$param['username']}'");

        if(!$result)
            return false;
        else
            return true;
    }

    /**
     * Cambia la contraseña del usuario actual
     *
     * @author jcocina
     * @param $param array
     *                  password        contraseña actual
     *                  password-nueva  contraseña nueva
     * @return bool true si el cambio es correcto
     */
    public function changePassword($param) {
        if (!isset($param['password']) or !isset($param['password-nueva'])) {
            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }
        $user = $this->show(array('id' => $this->session->get("auth-identity")['id']));
        if(!$user) {
            $this->error[] = $this->errors->NO_RECORDS_FOUND;
            return false;
        }

        $password = $param['password'];

        if (!$this->security->checkHash($password, $user->password)) {
            $this->error[] = $this->errors->WRONG_PASSWORD;

            return false;
        }
        $user->password = $this->getDI()
            ->getSecurity()
            ->hash($param['password-nueva']);
        if (!$user->save()) {
            $this->error[] = $this->errors->UNKNOW;
            return false;
        }
        return true;
    }

    /**
     * Cambiar el avatar del usuario logueado.
     *
     * @author jcocina
     * @param $param 'imgdir' ruta de la imagen
     * @return bool  true si la operacion es correcta
     */
    public function changeAvatar($param) {
        if (!isset($param['imgdir'])) {
            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }
        $user = $this->show(array('id' => $this->session->get("auth-identity")['id']));
        if(!$user) {
            $this->error[] = $this->errors->NO_RECORDS_FOUND;
            return false;
        }
        $user->avatar = $param['imgdir'];
        if (!$user->save()) {
            $this->error[] = $this->errors->UNKNOW;
            return false;
        }
        return true;
    }

    /**
     * Trae la lista completa de roles
     * @param void
     * @return array de roles
     *          'id' => 'name'
     */
    public function getAllRoles() {
        $roles = Roles::find();
        $roles_ = array('' => '-');
        if($roles->count() != 0){
            foreach ($roles as $role) {
                $roles_[$role->id] = $role->name;
            }
            return $roles_;
        } else {
            $this->error[] = $this->errors->NO_RECORDS_FOUND;
            return false;
        }

    }


    /**
     * Trae la lista completa de usuarios
     * @param void
     * @return lista de objetos users
     */
    public function getUsers($param) {
        $query = "";
        $and = false;

        if (isset($param['id']) and !empty($param['id'])) {
            if ($and) {
                $query = $query . " and id = " . $param['id'];
            } else {
                $query = $query . " id = " . $param['id'];
                $and = true;
            }
        }

        if (isset($param['username']) and !empty($param['username'])) {
            if ($and) {
                $query = $query . " and username = '" . $param['username'] . "'";
            } else {
                $query = $query . " username = '" . $param['username'] . "'";
                $and = true;
            }
        }

        if (isset($param['email']) and !empty($param['email'])) {
            if ($and) {
                $query = $query . " and email = '" . $param['email'] . "'";
            } else {
                $query = $query . " email = '" . $param['email'] . "'";
                $and = true;
            }
        }

        if (isset($param['must_change_password']) and !empty($param['must_change_password'])) {
            if ($and) {
                $query = $query . " and must_change_password = " . $param['must_change_password'];
            } else {
                $query = $query . " must_change_password = " . $param['must_change_password'];
                $and = true;
            }
        }

        if (isset($param['banned']) and !empty($param['banned'])) {
            if ($and) {
                $query = $query . " and banned = '" . $param['banned'] . "'";
            } else {
                $query = $query . " banned = '" . $param['banned'] . "'";
                $and = true;
            }
        }

        if (isset($param['suspended']) and !empty($param['suspended'])) {
            if ($and) {
                $query = $query . " and suspended = '" . $param['suspended'] . "'";
            } else {
                $query = $query . " suspended = '" . $param['suspended'] . "'";
                $and = true;
            }
        }

        if (isset($param['active']) and !empty($param['active'])) {
            if ($and) {
                $query = $query . " and active = '" . $param['active'] . "'";
            } else {
                $query = $query . " active = '" . $param['active'] . "'";
                $and = true;
            }
        }

        if (isset($param['role_id']) and !empty($param['role_id'])) {
            if ($and) {
                $query = $query . " and role_id = " . $param['role_id'];
            } else {
                $query = $query . " role_id = " . $param['role_id'];
                $and = true;
            }
        }

        if (isset($param['created_at']) and !empty($param['created_at'])) {
            if ($and) {
                $query = $query . " and created_at = '" . $param['created_at'] . "'";
            } else {
                $query = $query . " created_at = '" . $param['created_at'] . "'";
                $and = true;
            }
        }

        $users = Users::find($query);

        if($users->count() != 0){
            return $users;
        } else {
            $this->error[] = $this->errors->NO_RECORDS_FOUND;
            return false;
        }

    }

    /**
     * Trata de eliminar un usuario por completo
     *
     * @author jcocina
     * @param $param id id del usuario
     * @return bool true si la operacion se realiza correctamente
     */
    public  function deleteCompleteUser ($param) {
        if (!isset($param['id'])) {
            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }

        $user = Users::findFirst('id = ' . $param['id']);
        if (!$user) {
            $this->error[] = $this->errors->NO_RECORDS_FOUND;
            return false;
        }

        $user_details = UserDetails::findFirst('user_id = ' . $param['id']);
        if ($user_details) {
            if (!$user_details->delete() or !$user->delete()) {
                $this->error[] = $this->errors->UNKNOW;
                return false;
            } else {
                return true;
            }
        }
        if (!$user->delete()) {
            $this->error[] = $this->errors->UNKNOW;
            return false;
        } else {
            return true;
        }
    }

    public  function deleteCompleteUserDetails ($param) {
        if (!isset($param['user_id'])) {
            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }

        $user_details = UserDetails::findFirst('user_id = ' . $param['user_id']);

        if (!$user_details) {
            $this->error[] = $this->errors->NO_RECORDS_FOUND;
            return false;
        }

        if ($user_details) {
            if (!$user_details->delete()) {
                $this->error[] = $this->errors->UNKNOW;
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * Trae un objeto userDetails
     *
     * @author jcocina
     * @param $param user_id id del usuario
     * @return UserDetails|bool
     */
    public function showDetails($param) {
        extract($param);

        if (!isset($user_id)) {

            $this->error[] = $this->errors->MISSING_PARAMETERS;
            return false;
        }

        $result = UserDetails::findFirst('user_id = ' . $user_id);


        if($result != false)
            return $result;
        else{
            $this->error[] = $this->errors->NO_RECORDS_FOUND;
            return false;
        }
    }

    /**
     * Trae la lista de usrnames o emails asociados a los ids de usuarios
     * @param void
     * @return Array    donde las keys son los id de los usuarios
     *                  y los values los emails o usernames.
     */
    public function usernameList() {
        $users = Users::find();

        $users_ = array('' => '-');
        if($users->count() != 0){

            foreach ($users as $user) {

                if (!empty($user->username) and isset($user->username)) {
                    $users_[$user->id] = $user->username;
                } else if (!empty($user->email) and isset($user->email)) {
                    $users_[$user->id] = $user->email;
                }

            }

            return $users_;
        } else {
            $this->error[] = $this->errors->NO_RECORDS_FOUND;
            return false;
        }
    }

    public function getUserDetails($param) {

        $query = "";
        $and = false;

        if (isset($param['user_id']) and !empty($param['user_id'])) {
            if ($and) {
                $query = $query . " and user_id = " . $param['user_id'];
            } else {
                $query = $query . " user_id = " . $param['user_id'];
                $and = true;
            }
        }

        if (isset($param['firstname']) and !empty($param['firstname'])) {
            if ($and) {
                $query = $query . " and firstname = '" . $param['firstname'] . "'";
            } else {
                $query = $query . " firstname = '" . $param['firstname'] . "'";
                $and = true;
            }
        }

        if (isset($param['lastname']) and !empty($param['lastname'])) {
            if ($and) {
                $query = $query . " and lastname = '" . $param['lastname'] . "'";
            } else {
                $query = $query . " lastname = '" . $param['lastname'] . "'";
                $and = true;
            }
        }

        if (isset($param['rut']) and !empty($param['rut'])) {
            if ($and) {
                $query = $query . " and rut = '" . $param['rut'] . "'";
            } else {
                $query = $query . " rut = '" . $param['rut'] . "'";
                $and = true;
            }
        }

        if (isset($param['location']) and !empty($param['location'])) {
            if ($and) {
                $query = $query . " and location = '" . $param['location'] . "'";
            } else {
                $query = $query . " location = '" . $param['location'] . "'";
                $and = true;
            }
        }

        if (isset($param['phone_fixed']) and !empty($param['phone_fixed'])) {
            if ($and) {
                $query = $query . " and phone_fixed = '" . $param['phone_fixed'] . "'";
            } else {
                $query = $query . " phone_fixed = '" . $param['phone_fixed'] . "'";
                $and = true;
            }
        }

        if (isset($param['phone_mobile']) and !empty($param['phone_mobile'])) {
            if ($and) {
                $query = $query . " and phone_mobile = '" . $param['phone_mobile'] . "'";
            } else {
                $query = $query . " phone_mobile = '" . $param['phone_mobile'] . "'";
                $and = true;
            }
        }

        if (isset($param['sexo']) and !empty($param['sexo'])) {
            if ($and) {
                $query = $query . " and sexo = '" . $param['sexo'] . "'";
            } else {
                $query = $query . " sexo = '" . $param['sexo'] . "'";
                $and = true;
            }
        }

        if (isset($param['birthdate']) and !empty($param['birthdate'])) {
            if ($and) {
                $query = $query . " and birthdate = '" . $param['birthdate'] . "'";
            } else {
                $query = $query . " birthdate = '" . $param['birthdate'] . "'";
                $and = true;
            }
        }

        $users = UserDetails::find($query);

        if($users->count() != 0){
            return $users;
        } else {
            $this->error[] = $this->errors->NO_RECORDS_FOUND;
            return false;
        }

    }

}
