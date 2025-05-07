<?php
namespace model;
require_once "DaoInterface.php";
require_once "DbConnect.php";
require_once "User.php";
require_once "Role.php";
require_once "RoleDao.php";

use PDO;
use PDOException;

/**
 * Data access object in the database for users.
 */
class UserDao implements DaoInterface
{
    /**
     * @return User|null the selected user or null if not found
     */
    public function selectById(int $id): ?User
    {
        try {
            $stmt = DbConnect::getDb()->prepare("SELECT * FROM \"user\" WHERE id_user = ?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) return null;

            $role_id = $row['id_role'];

            $role = (new RoleDao())->selectById($role_id);

            return new User($row['id_user'], $row['mail'], $row['tel'], $row['nom'], $row['prenom'], $row['mdp'], $role);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return null;
    }

    /**
     * @return array an array containing all the existing selected users.
     */
    public function selectAll(): array
    {
        $users = [];
        try {
            $stmt = DbConnect::getDb()->prepare("SELECT * FROM \"user\"");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $role_id = $row['id_role'];
                $role = (new RoleDao())->selectById($role_id);
                $users[] = new User($row['id_user'], $row['mail'], $row['tel'], $row['nom'], $row['prenom'], $row['mdp'], $role);
            }

            return $users;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $users;
    }

    /**
     * Selects all users that have been assigned a designate role.
     * 
     * @param int $role_id the id of the role searched for.
     * @return array contains all found users.
     */
    public function selectAllByRoleId(int $role_id): array
    {
        $users = [];
        try {
            $stmt = DbConnect::getDb()->prepare("SELECT * FROM \"user\" WHERE id_role = ?");
            $stmt->bindValue(1, $role_id);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $role = (new RoleDao())->selectById($role_id);
                $users[] = new User($row['id_user'], $row['mail'], $row['tel'], $row['nom'], $row['prenom'], $row['mdp'], $role);
            }

            return $users;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $users;
    }

    /**
     * @param User|Model $data the user to create in the db, of Model descent.
     * @return bool indicates if the insertion was successful (true) or not (false).
     */
    public function insert(User|Model $data): bool
    {
        $conn = DbConnect::getDb();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO \"user\" (mail, nom, prenom, tel, mdp, id_role) VALUES (?, ?, ?, ?, ?, ?) RETURNING id_user");
            $stmt->bindValue(1, $data->email);
            $stmt->bindValue(2, $data->name);
            $stmt->bindValue(3, $data->firstname);
            $stmt->bindValue(4, $data->tel);
            $stmt->bindValue(5, $data->password);
            $stmt->bindValue(6, $data->role->id);
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
     * @param User|Model $data the already updated user corresponding to the user to update in the db.
     * Thus, be careful to have matching id's.
     * @return bool indicates if the insertion was successful (true) or not (false).
     */
    public function update(User|Model $data): bool
    {
        $conn = DbConnect::getDb();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare("UPDATE \"user\" SET mail = ?, nom = ?, prenom = ?, tel = ?, mdp = ?, id_role = ? WHERE id_user = ?");
            $stmt->bindValue(1, $data->email);
            $stmt->bindValue(2, $data->name);
            $stmt->bindValue(3, $data->firstname);
            $stmt->bindValue(4, $data->tel);
            $stmt->bindValue(5, $data->password);
            $stmt->bindValue(6, $data->role->id);
            $stmt->bindValue(7, $data->id);
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
    public function delete(int $id): bool
    {
        $conn = DbConnect::getDb();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare("DELETE FROM \"user\" WHERE id_user = ?");
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

    /**
     * Finds a user in the db according to its email.
     * 
     * @param string $email the email of the searched user.
     * @return User|null the corresponding user, or null if not found.
     */
    public function getByEmail(string $email) : ?User {
        try {
            $stmt = DbConnect::getDb()->prepare("SELECT * FROM \"user\" WHERE mail = ?");
            $stmt->bindValue(1, $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) return null;

            $role_id = $row['id_role'];

            $role = (new RoleDao())->selectById($role_id);

            return new User($row['id_user'], $row['mail'], $row['tel'], $row['nom'], $row['prenom'], $row['mdp'], $role);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return null;
    }
}