<?php

namespace App\Models;

use Phalcon\Mvc\Model\Validator\Email as Email;
use App\Business\UserBSN;
use Phalcon\Mvc\Model\Message;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $username;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $avatar;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var integer
     */
    public $must_change_password;

    /**
     *
     * @var string
     */
    public $banned;

    /**
     *
     * @var string
     */
    public $suspended;

    /**
     *
     * @var string
     */
    public $active;

    /**
     *
     * @var integer
     */
    public $role_id;

    /**
     *
     * @var string
     */
    public $created_at;



    public function beforeValidationOnCreate()
    {
        $this->created_at = date('Y-m-d H:i:s');
        $this->must_change_password = 0;
        if (empty($this->avatar)) {
            $this->avatar = 'pic/avatars/default.png';
        }
        if (empty($this->password)) {

            // Generate a plain temporary password
            $tempPassword = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(12)));

            // Use this password as default
            $this->password = $this->getDI()
                ->getSecurity()
                ->hash($tempPassword);
            $this->must_change_password = 1;
        } else {
            $this->password = $this->getDI()
                ->getSecurity()
                ->hash($this->password);
        }
    }




    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', __NAMESPACE__.'\Agreements', 'user_id', array('alias' => 'Agreements'));
        $this->hasMany('id', __NAMESPACE__.'\Turns', 'user_patient_id', array('alias' => 'Turns'));
        $this->belongsTo('id', __NAMESPACE__.'\UserDetails', 'user_id', array('alias' => 'UserDetails'));
        $this->hasMany('id', __NAMESPACE__.'\UsersSpecialtiesBranchoffices', 'user_id', array('alias' => 'UsersSpecialtiesBranchoffices'));
        $this->belongsTo('role_id', __NAMESPACE__.'\Roles', 'id', array('alias' => 'Roles'));

        $this->belongsTo('sucursal', __NAMESPACE__.'\BranchOffices', 'id', array('alias' => 'BranchOffices'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
