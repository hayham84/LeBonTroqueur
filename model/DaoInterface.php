<?php

namespace model;

require_once "Model.php";

/**
 * Interface that provides the service for interacting with the database.
 * Its children are Data Access Objects (DAO).
 */
interface DaoInterface
{

    /**
     * Selects in the database the object, of Model descent, corresponding to a unique id.
     *
     * @param int $id the unique id of the object we want to select.
     * @return Model|null An object descending from the abstract class Model. Null if the object does not exist in the db.
     */
    function selectById(int $id): ?Model;

    /**
     * Selects all existing elements of an object type descending from Model, in the database.
     *
     * @return array an array containing all the existing selected objects.
     */
    function selectAll(): array;

    /**
     * Creates/inserts an object in the database of Model descent.
     *
     * @param Model $data the object to create in the db, of Model descent.
     * @return bool indicates if the insertion was successful (true) or not (false).
     */
    function insert(Model $data): bool;

    /**
     * Updates an object in the db.
     *
     * @param Model $data the already updated object corresponding to the object to update in the db. Thus, be careful to have matching id's.
     * @return bool indicates if the insertion was successful (true) or not (false).
     */
    function update(Model $data): bool;

    /**
     * Deletes an object in the db.
     *
     * @param int $id the id of the object to delete. Thus, be careful to have matching id's.
     * @return bool indicates if the insertion was successful (true) or not (false).
     */
    function delete(int $id): bool;
}