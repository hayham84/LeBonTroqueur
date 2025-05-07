<?php

namespace model;

/**
 * A role indicates the privilege power of a user.
 * It extends the abstract class Model, which provides a unique identifier.
 *
 * @property string role_name the name of the role.
 */
class Role extends Model
{
    protected string $role_name;

    /**
     * @param int $id the unique id of the role.
     * @param string $role_name the name of the role.
     */
    public function __construct(int $id, string $role_name)
    {
        parent::__construct($id);
        $this->role_name = $role_name;
    }
}