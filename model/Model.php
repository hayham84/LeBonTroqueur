<?php

namespace model;

use Exception;

/**
 * A parent class for all objects corresponding to an object in the database.
 * Provides necessities such as get and set, and an identifier which existence is common to all db objects.
 *
 * @property int id the unique identifier used to apply various transformations on the object in the database.
 */
abstract class Model
{
    private int $id;

    /**
     * Model constructor.
     *
     * @param int $id the unique id of the object.
     */
    protected function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Magic function to get properties.
     * <p>
     *      Usage : object->property
     *
     * @throws Exception if the property does not exist.
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new Exception("Property '$name' does not exist");
    }

    /**
     * Magic function to set the properties.
     * <p>
     *     Usage : object->property = variable
     *
     * @throws Exception if the property does not exist.
     */
    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new Exception("Property '$name' does not exist");
        }
    }

}