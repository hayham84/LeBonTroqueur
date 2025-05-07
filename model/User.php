<?php

namespace model;

require_once "Model.php";

/**
 * The user is the person that interacts with the website. It normally is a human person that has personal information.
 * It extends the abstract class Model, which provides a unique identifier.
 *
 * @property string $email the email of the user.
 * @property string $name the (last) name of the user.
 * @property string $firstname the firstname of the user.
 * @property string $tel the phone number of the user.
 * @property string $password the hashed password of the user.
 * @property Role $role the role of the user (role user, id 2, by default).
 */
class User extends Model
{

    protected string $name;
    protected string $firstname;
    protected string $password;
    protected string $email;
    protected Role $role;
    protected string $tel;

    /**
     * User constructor.
     *
     * @param int $id the unique id of the user.
     * @param string $email the email of the user.
     * @param string $tel the phone number of the user.
     * @param string $name the (last) name of the user.
     * @param string $firstname the firstname of the user.
     * @param string $password the hashed password of the user.
     * @param Role $role the role of the user (role user, id 2, by default).
     */
    public function __construct(int $id, string $email, string $tel, string $name, string $firstname, string $password, Role $role)
    {
        parent::__construct($id);
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->role = $role;
        $this->tel = $tel;
    }

}