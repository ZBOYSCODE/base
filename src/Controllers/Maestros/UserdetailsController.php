<?php
 namespace App\Controllers\Maestros;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use App\Models\UserDetails;
use App\Models\Users;

class UserDetailsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;

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
        }
        $this->view->users = $users_;

        $this->view->pick('controllers/maestros/user_details/index');
    }

    /**
     * Searches for user_details
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'App\Models\UserDetails', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "user_id";

        $user_details = UserDetails::find($parameters);
        if (count($user_details) == 0) {
            $this->flash->notice("The search did not find any user_details");

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

        $users = Users::find();
        $users_ = array();
        if($users->count() != 0){
            foreach ($users as $user) {
                if (!empty($user->username) and isset($user->username)) {
                    $users_[$user->id] = $user->username;
                } else if (!empty($user->email) and isset($user->email)) {
                    $users_[$user->id] = $user->email;
                } else {
                    $users_[$user->id] = $user->id;
                }
            }
        }
        $this->view->users = $users_;


        $this->view->pick('controllers/maestros/user_details/search');
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $users = Users::find();
        $users_ = array();
        if($users->count() != 0){
            foreach ($users as $user) {
                if (!empty($user->username) and isset($user->username)) {
                    $users_[$user->id] = $user->username;
                } else if (!empty($user->email) and isset($user->email)) {
                    $users_[$user->id] = $user->email;
                } else {
                    $users_[$user->id] = $user->id;
                }
            }
        }
        $this->view->users = $users_;


        $this->view->pick('controllers/maestros/user_details/new');
    }

    /**
     * Edits a user_detail
     *
     * @param string $user_id
     */
    public function editAction($user_id)
    {
        if (!$this->request->isPost()) {

            $user_detail = UserDetails::findFirstByuser_id($user_id);
            if (!$user_detail) {
                $this->flash->error("user_detail was not found");

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
            $this->tag->setDefault("medical_plan_id", $user_detail->medical_plan_id);
            $this->tag->setDefault("comments", $user_detail->comments);
            $this->tag->setDefault("cities_id", $user_detail->cities_id);
            $this->tag->setDefault("sexo", $user_detail->sexo);
            $this->tag->setDefault("birthdate", $user_detail->birthdate);
            $this->tag->setDefault("district_id", $user_detail->district_id);

            $users = Users::find();
            $users_ = array();
            if($users->count() != 0){
                foreach ($users as $user) {
                    if (!empty($user->username) and isset($user->username)) {
                        $users_[$user->id] = $user->username;
                    } else if (!empty($user->email) and isset($user->email)) {
                        $users_[$user->id] = $user->email;
                    } else {
                        $users_[$user->id] = $user->id;
                    }
                }
            }
            $this->view->users = $users_;



            $this->view->pick('controllers/maestros/user_details/edit');
        }
    }

    /**
     * Creates a new user_detail
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "user_details",
                'action' => 'index'
            ));

            return;
        }

        $user_detail = new UserDetails();
        $user_detail->user_id = $this->request->getPost("user_id");
        $user_detail->firstname = $this->request->getPost("firstname");
        $user_detail->lastname = $this->request->getPost("lastname");
        $user_detail->rut = $this->request->getPost("rut");
        $user_detail->location = $this->request->getPost("location");
        $user_detail->phone_fixed = $this->request->getPost("phone_fixed");
        $user_detail->phone_mobile = $this->request->getPost("phone_mobile");
        $user_detail->medical_plan_id = $this->request->getPost("medical_plan_id");
        $user_detail->comments = $this->request->getPost("comments");
        $user_detail->cities_id = $this->request->getPost("cities_id");
        $user_detail->sexo = $this->request->getPost("sexo");
        $user_detail->birthdate = $this->request->getPost("birthdate");
        $user_detail->district_id = $this->request->getPost("district_id");
        

        if (!$user_detail->save()) {
            foreach ($user_detail->getMessages() as $message) {
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

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "user_details",
                'action' => 'index'
            ));

            return;
        }

        $user_id = $this->request->getPost("user_id");
        $user_detail = UserDetails::findFirstByuser_id($user_id);

        if (!$user_detail) {
            $this->flash->error("user_detail does not exist " . $user_id);

            $this->dispatcher->forward(array(
                'controller' => "user_details",
                'action' => 'index'
            ));

            return;
        }

        $user_detail->user_id = $this->request->getPost("user_id");
        $user_detail->firstname = $this->request->getPost("firstname");
        $user_detail->lastname = $this->request->getPost("lastname");
        $user_detail->rut = $this->request->getPost("rut");
        $user_detail->location = $this->request->getPost("location");
        $user_detail->phone_fixed = $this->request->getPost("phone_fixed");
        $user_detail->phone_mobile = $this->request->getPost("phone_mobile");
        $user_detail->medical_plan_id = $this->request->getPost("medical_plan_id");
        $user_detail->comments = $this->request->getPost("comments");
        $user_detail->cities_id = $this->request->getPost("cities_id");
        $user_detail->sexo = $this->request->getPost("sexo");
        $user_detail->birthdate = $this->request->getPost("birthdate");
        $user_detail->district_id = $this->request->getPost("district_id");
        

        if (!$user_detail->save()) {

            foreach ($user_detail->getMessages() as $message) {
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
        $user_detail = UserDetails::findFirstByuser_id($user_id);
        if (!$user_detail) {
            $this->flash->error("user_detail was not found");

            $this->dispatcher->forward(array(
                'controller' => "user_details",
                'action' => 'index'
            ));

            return;
        }

        if (!$user_detail->delete()) {

            foreach ($user_detail->getMessages() as $message) {
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
