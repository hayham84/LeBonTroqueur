<?php

namespace model;

require_once "DbConnect.php";
require_once "Role.php";
require_once "DaoInterface.php";

use PDO;
use PDOException;

/**
 * Data access object in the database for roles.
 */
class RoleDao implements DaoInterface
{
    /**
     * @return Role|null the selected role or null if not found
     */
    function selectById(int $id): ?Role
    {
        try {
            $stmt = DbConnect::getDb()->prepare("SELECT * FROM \"role\" WHERE id_role = ?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row ? new Role($row['id_role'], $row['nom_role']) : null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return null;
    }

    /**
     * @return array an array containing all the existing selected roles.
     */
    function selectAll(): array
    {
        $roles = [];
        try {
            $stmt = DbConnect::getDb()->prepare("SELECT * FROM \"role\"");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $roles[] = new Role($row['id_role'], $row['nom_role']);
            }
            return $roles;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $roles;
    }

    /**
     * @param Role|Model $data the role to create in the db, of Model descent.
     * @return bool indicates if the insertion was successful (true) or not (false).
     */
    function insert($data): bool
    {
        $conn = DbConnect::getDb();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO \"role\" (nom_role) VALUES (?) RETURNING id_role");
            $stmt->bindValue(1, $data->role_name);
            $stmt->execute();
            $data->id = $stmt->fetchColumn();
            $conn->commit();
            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
            echo $e->getMessage();
        }
        return false;
    }

    /**
     * @param Role|Model $data the already updated role corresponding to the role to update in the db.
     * Thus, be careful to have matching id's.
     * @return bool indicates if the insertion was successful (true) or not (false).
     */
    function update(Role|Model $data): bool
    {
        $conn = DbConnect::getDb();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare("UPDATE \"role\" SET nom_role = ? WHERE id_role = ?");
            $stmt->bindValue(1, $data->role_name);
            $stmt->bindValue(2, $data->id);
            $stmt->execute();
            $conn->commit();
            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
            echo $e->getMessage();
        }
        return false;
    }

    /**
     * @return bool indicates if the insertion was successful (true) or not (false).
     */
    function delete(int $id): bool
    {
        $conn = DbConnect::getDb();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare("DELETE FROM \"role\" WHERE id_role = ?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $conn->commit();
            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
            echo $e->getMessage();
        }
        return false;
    }
}