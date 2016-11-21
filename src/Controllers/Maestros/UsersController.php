<?php
 namespace App\Controllers\Maestros;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use App\Models\Users;
use App\Models\Roles;

class UsersController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;

        $roles = Roles::find();
        $roles_ = array('' => '-');
        if($roles->count() != 0){
            foreach ($roles as $role) {
                $roles_[$role->id] = $role->name;
            }
        }
        $this->view->roles = $roles_;

        $this->view->pick('controllers/maestros/users/index');
    }

    /**
     * Searches for users
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'App\Models\Users', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $users = Users::find($parameters);
        if (count($users) == 0) {
            $this->flash->notice("The search did not find any users");

            $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));

            return;
        }

        $paginator = new Paginator(array(
            'data' => $users,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();

        $roles = Roles::find();
        $roles_ = array();
        if($roles->count() != 0){
            foreach ($roles as $role) {
                $roles_[$role->id] = $role->name;
            }
        }
        $this->view->roles = $roles_;

        $this->view->baseUri = $this->di->get('url')->getBaseUri();

        $this->view->pick('controllers/maestros/users/search');
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {


        $roles = Roles::find();
        $roles_ = array();
        if($roles->count() != 0){
            foreach ($roles as $role) {
                $roles_[$role->id] = $role->name;
            }
        }
        $this->view->roles = $roles_;

        $this->view->pick('controllers/maestros/users/new');
    }

    /**
     * Edits a user
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $user = Users::findFirstByid($id);
            if (!$user) {
                $this->flash->error("user was not found");

                $this->dispatcher->forward(array(
                    'controller' => "users",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $user->id;

            $this->tag->setDefault("id", $user->id);
            $this->tag->setDefault("username", $user->username);
            $this->tag->setDefault("email", $user->email);
            $this->tag->setDefault("avatar", $user->avatar);
            $this->tag->setDefault("password", '');
            $this->tag->setDefault("must_change_password", $user->must_change_password);
            $this->tag->setDefault("banned", $user->banned);
            $this->tag->setDefault("suspended", $user->suspended);
            $this->tag->setDefault("active", $user->active);
            $this->tag->setDefault("role_id", $user->role_id);
            $this->tag->setDefault("created_at", $user->created_at);
            $this->tag->setDefault("sucursal", $user->sucursal);


            $roles = Roles::find();
            $roles_ = array();
            if($roles->count() != 0){
                foreach ($roles as $role) {
                    $roles_[$role->id] = $role->name;
                }
            }
            $this->view->roles = $roles_;

            $this->view->pick('controllers/maestros/users/edit');
        }
    }

    /**
     * Creates a new user
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }

        $user = new Users();
        $user->username = $this->request->getPost("username");
        $user->email = $this->request->getPost("email", "email");
        $user->avatar = $this->request->getPost("avatar");
        $user->password = $this->request->getPost("password");
        $user->banned = $this->request->getPost("banned");
        $user->suspended = $this->request->getPost("suspended");
        $user->active = $this->request->getPost("active");
        $user->role_id = $this->request->getPost("role_id");
        $user->sucursal = $this->request->getPost("sucursal");
        

        if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("user was created successfully");

        $this->contextRedirect("maestros/users/search");
    }

    /**
     * Saves a user edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {

            $this->contextRedirect("maestros/users");
            return;
        }

        $id = $this->request->getPost("id");
        $user = Users::findFirstByid($id);

        if (!$user) {
            $this->flash->error("user does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }

        $user->username = $this->request->getPost("username");
        $user->email = $this->request->getPost("email", "email");
        $user->avatar = $this->request->getPost("avatar");
        $pass = $this->request->getPost("password");
        if (!isset($pass) or !empty($pass)) {
            $user->password = $this->getDI()
                ->getSecurity()
                ->hash($pass);
        }
        $user->banned = $this->request->getPost("banned");
        $user->suspended = $this->request->getPost("suspended");
        $user->active = $this->request->getPost("active");
        $user->role_id = $this->request->getPost("role_id");
        $user->sucursal = $this->request->getPost("sucursal");
        

        if (!$user->save()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'edit',
                'params' => array($user->id)
            ));

            return;
        }

        $this->flash->success("user was updated successfully");

        $this->contextRedirect("maestros/users/search");
    }

    /**
     * Deletes a user
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $user = Users::findFirstByid($id);
        if (!$user) {
            $this->flash->error("user was not found");

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }

        if (!$user->delete()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("user was deleted successfully");

        $this->contextRedirect("maestros/users/search");
    }

}
