<?php
 namespace App\Controllers\Maestros;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use App\Business\UserBSN;

class UsersController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;

        $bsn = new UserBSN();

        $this->view->roles = $bsn->getAllRoles();

        $this->view->pick('controllers/maestros/users/index');
    }

    /**
     * Searches for users
     */
    public function searchAction()
    {
        $bsn = new UserBSN();
        $numberPage = 1;
        $parametters = array();
        if ($this->request->isPost()) {
            $parametters['id'] = $this->request->getPost("id");
            $parametters['username'] = $this->request->getPost("username");
            $parametters['email'] = $this->request->getPost("email", "email");
            $parametters['avatar'] = $this->request->getPost("avatar");
            $parametters['password'] = $this->request->getPost("password");
            $parametters['banned'] = $this->request->getPost("banned");
            $parametters['suspended'] = $this->request->getPost("suspended");
            $parametters['active'] = $this->request->getPost("active");
            $parametters['role_id'] = $this->request->getPost("role_id");
            $parametters['created_at'] = $this->request->getPost("created_at");
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $users = $bsn->getUsers($parametters);
        if (!$users) {
            $msg = '';
            foreach ($bsn->error as $err) {
                $msg = $msg . ' ' . $err;
            }
            $this->flash->error($msg);

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

        $this->view->roles = $bsn->getAllRoles();

        $this->view->baseUri = $this->di->get('url')->getBaseUri();

        $this->view->pick('controllers/maestros/users/search');
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

        $bsn = new UserBSN();

        $this->view->roles = $bsn->getAllRoles();

        $this->view->pick('controllers/maestros/users/new');
    }

    /**
     * Edits a user
     *
     * @param string $id
     */
    public function editAction($id)
    {
        $bsn = new UserBSN();

        if (!$this->request->isPost()) {

            $param = array(
                'id' => $id
            );

            $user = $bsn->show($param);
            if (!$user) {
                $msg = '';
                foreach ($bsn->error as $err) {
                    $msg = $msg . ' ' . $err;
                }
                $this->flash->error($msg);

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

            $this->view->roles = $bsn->getAllRoles();

            $this->view->pick('controllers/maestros/users/edit');
        }
    }

    /**
     * Creates a new user
     */
    public function createAction()
    {
        $bsn = new UserBSN();
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }

        $parametter = array(
            'username' => $this->request->getPost("username"),
            'email' => $this->request->getPost("email", "email"),
            'avatar' => $this->request->getPost("avatar"),
            'password' => $this->request->getPost("password"),
            'banned' => $this->request->getPost("banned"),
            'suspended' => $this->request->getPost("suspended"),
            'active' => $this->request->getPost("active"),
            'role_id' => $this->request->getPost("role_id")
        );

        if (!$bsn->createUser($parametter)) {
            foreach ($bsn->error as $message) {
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
        $bsn = new UserBSN();

        if (!$this->request->isPost()) {

            $this->contextRedirect("maestros/users");
            return;
        }

        $id = $this->request->getPost("id");

        $param = array(
            'id' => $id
        );

        $user = $bsn->show($param);

        if (!$user) {
            foreach ($bsn->error as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }
        $parametters = array(
            'id' => $id
        );
        $parametters['username'] = $this->request->getPost("username");
        $parametters['email'] = $this->request->getPost("email", "email");
        $parametters['avatar'] = $this->request->getPost("avatar");
        $parametters['password'] = $this->request->getPost("password");
        $parametters['banned'] = $this->request->getPost("banned");
        $parametters['suspended'] = $this->request->getPost("suspended");
        $parametters['active'] = $this->request->getPost("active");
        $parametters['role_id'] = $this->request->getPost("role_id");
        

        if (!$bsn->editUser($parametters)) {

            foreach ($bsn->error as $message) {
                $this->flash->error($message);
            }

            $this->contextRedirect("maestros/users/edit/" . $id);

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
        $bsn = new UserBSN();

        $param = array(
            'id' => $id
        );

        $user = $bsn->show($param);

        if (!$user) {

            foreach ($bsn->error as $message) {
                $this->flash->error($message);
            }

            return;
        }

        if (!$bsn->deleteCompleteUser($param)) {

            foreach ($bsn->error as $message) {
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
