<?php
 namespace App\Controllers\Maestros;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use App\Business\UserBSN;

class UserDetailsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $bsn = new UserBSN();

        $this->persistent->parameters = null;


        $this->view->users = $bsn->usernameList();

        $this->view->pick('controllers/maestros/user_details/index');
    }

    /**
     * Searches for user_details
     */
    public function searchAction()
    {
        $bsn = new UserBSN();

        $numberPage = 1;
        $parametters = array();
        if ($this->request->isPost()) {
            $parametters['user_id'] = $this->request->getPost("user_id");
            $parametters['firstname'] = $this->request->getPost("firstname");
            $parametters['lastname'] = $this->request->getPost("lastname");
            $parametters['rut'] = $this->request->getPost("rut");
            $parametters['location'] = $this->request->getPost("location");
            $parametters['phone_fixed'] = $this->request->getPost("phone_fixed");
            $parametters['phone_mobile'] = $this->request->getPost("phone_mobile");
            $parametters['comments'] = $this->request->getPost("comments");
            $parametters['sexo'] = $this->request->getPost("sexo");
            $parametters['birthdate'] = $this->request->getPost("birthdate");
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $user_details = $bsn->getUserDetails($parametters);

        if (!$user_details) {
            foreach ($bsn->error as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                "controller" => "user_details",
                "action" => "index"
            ));

            return;
        }

        $paginator = new Paginator(array(
            'data' => $user_details,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();

        $this->view->users = $bsn->usernameList();


        $this->view->pick('controllers/maestros/user_details/search');
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $bsn = new UserBSN();

        $this->view->users = $bsn->usernameList();


        $this->view->pick('controllers/maestros/user_details/new');
    }

    /**
     * Edits a user_detail
     *
     * @param string $user_id
     */
    public function editAction($user_id)
    {
        $bsn = new UserBSN();

        if (!$this->request->isPost()) {

            $param = array(
                'user_id' => $user_id
            );

            $user_detail = $bsn->showDetails($param);

            if (!$user_detail) {
                foreach ($bsn->error as $message) {
                    $this->flash->error($message);
                }

                $this->dispatcher->forward(array(
                    'controller' => "user_details",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->user_id = $user_detail->user_id;

            $this->tag->setDefault("user_id", $user_detail->user_id);
            $this->tag->setDefault("firstname", $user_detail->firstname);
            $this->tag->setDefault("lastname", $user_detail->lastname);
            $this->tag->setDefault("rut", $user_detail->rut);
            $this->tag->setDefault("location", $user_detail->location);
            $this->tag->setDefault("phone_fixed", $user_detail->phone_fixed);
            $this->tag->setDefault("phone_mobile", $user_detail->phone_mobile);
            $this->tag->setDefault("comments", $user_detail->comments);
            $this->tag->setDefault("sexo", $user_detail->sexo);
            $this->tag->setDefault("birthdate", $user_detail->birthdate);

            $this->view->users = $bsn->usernameList();


            $this->view->pick('controllers/maestros/user_details/edit');
        }
    }

    /**
     * Creates a new user_detail
     */
    public function createAction()
    {
        $bsn = new UserBSN();

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "user_details",
                'action' => 'index'
            ));

            return;
        }

        $parametter = array();

        $parametter['user_id'] = $this->request->getPost("user_id");
        $parametter['firstname'] = $this->request->getPost("firstname");
        $parametter['lastname'] = $this->request->getPost("lastname");
        $parametter['rut'] = $this->request->getPost("rut");
        $parametter['location'] = $this->request->getPost("location");
        $parametter['phone_fixed'] = $this->request->getPost("phone_fixed");
        $parametter['phone_mobile'] = $this->request->getPost("phone_mobile");
        $parametter['comments'] = $this->request->getPost("comments");
        $parametter['sexo'] = $this->request->getPost("sexo");
        $parametter['birthdate'] = $this->request->getPost("birthdate");
        

        if (!$bsn->createUserDetail($parametter)) {
            foreach ($bsn->error as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "user_details",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("user_detail was created successfully");

        $this->contextRedirect("maestros/user_details/search");
    }

    /**
     * Saves a user_detail edited
     *
     */
    public function saveAction()
    {
        $bsn = new UserBSN();

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "user_details",
                'action' => 'index'
            ));

            return;
        }

        $user_id = $this->request->getPost("user_id");

        $param = array(
            'user_id' => $user_id
        );

        $user_detail = $bsn->showDetails($param);

        if (!$user_detail) {
            foreach ($bsn->error as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "user_details",
                'action' => 'index'
            ));

            return;
        }

        $parametter = array();

        $parametter['user_id'] = $this->request->getPost("user_id");
        $parametter['firstname'] = $this->request->getPost("firstname");
        $parametter['lastname'] = $this->request->getPost("lastname");
        $parametter['rut'] = $this->request->getPost("rut");
        $parametter['location'] = $this->request->getPost("location");
        $parametter['phone_fixed'] = $this->request->getPost("phone_fixed");
        $parametter['phone_mobile'] = $this->request->getPost("phone_mobile");
        $parametter['comments'] = $this->request->getPost("comments");
        $parametter['sexo'] = $this->request->getPost("sexo");
        $parametter['birthdate'] = $this->request->getPost("birthdate");
        

        if (!$bsn->editUserDetails($parametter)) {

            foreach ($bsn->error as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "user_details",
                'action' => 'edit',
                'params' => array($user_detail->user_id)
            ));

            return;
        }

        $this->flash->success("user_detail was updated successfully");

        $this->contextRedirect("maestros/user_details/search");
    }

    /**
     * Deletes a user_detail
     *
     * @param string $user_id
     */
    public function deleteAction($user_id)
    {
        $bsn = new UserBSN();

        $param = array(
            'user_id' => $user_id
        );

        $user_detail = $bsn->showDetails($param);

        if (!$user_detail) {

            foreach ($bsn->error as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "user_details",
                'action' => 'index'
            ));

            return;
        }

        if (!$bsn->deleteCompleteUserDetails($param)) {


            foreach ($bsn->error as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "user_details",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("user_detail was deleted successfully");

        $this->contextRedirect("maestros/user_details/search");
    }

}
