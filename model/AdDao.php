<?php

namespace model;

require_once "Ad.php";
require_once "DbConnect.php";
require_once "DaoInterface.php";

use PDO;
use PDOException;

/**
 * Data access object in the database for advertisements.
 */
class AdDao implements DaoInterface
{
    /**
     * @return Ad|null the selected advertisement or null if not found
     */
    function selectById(int $id): ?Ad
    {
        try {
            $stmt = DbConnect::getDb()->prepare("SELECT * FROM \"annonce\" WHERE id_annonce = ?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row ? new Ad($row['id_annonce'], $row['title'], $row['localisation'], $row['description'], $row['price'], $row['id_user']) : null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return null;
    }

    /**
     * @return array an array containing all the existing selected advertisements.
     */
    function selectAll(): array
    {
        $ads = [];
        try {
            $stmt = DbConnect::getDb()->prepare("SELECT * FROM \"annonce\"");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ads[] = new Ad($row['id_annonce'], $row['title'], $row['localisation'], $row['description'], $row['price'], $row['id_user']);
            }

            return $ads;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $ads;
    }

    /**
     * @param Ad|Model $data the advertisement to create in the db, of Model descent.
     * @return bool indicates if the insertion was successful (true) or not (false).
     */
    function insert(Ad|Model $data): bool
    {
        $conn = DbConnect::getDb();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO \"annonce\" (title, description, localisation, price, id_user) VALUES (?, ?, ?, ?, ?) RETURNING id_annonce");
            $stmt->bindValue(1, $data->title);
            $stmt->bindValue(2, $data->description);
            $stmt->bindValue(3, $data->localisation);
            $stmt->bindValue(4, $data->price);
            $stmt->bindValue(5, $data->id_user);
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
     * @param Ad|Model $data the already updated advertisement corresponding to the advertisement to update in the db.
     * Thus, be careful to have matching id's.
     * @return bool indicates if the insertion was successful (true) or not (false).
     */
    function update($data): bool
    {
        $conn = DbConnect::getDb();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare("UPDATE \"annonce\" SET title = ?, description = ?, localisation = ?, price = ?, id_user = ? WHERE id_annonce = ?");
            $stmt->bindValue(1, $data->title);
            $stmt->bindValue(2, $data->description);
            $stmt->bindValue(3, $data->localisation);
            $stmt->bindValue(4, $data->price);
            $stmt->bindValue(5, $data->id_user);
            $stmt->bindValue(6, $data->id);
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
            $stmt = $conn->prepare("DELETE FROM \"annonce\" WHERE id_annonce = ?");
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
     * Selects all advertisements produced by a specified user.
     * 
     * @param int $id the unique id of the user.
     * @return array|null an array containing all advertisements for the user, null if the user does not have any advertisement.
     */
    function selectAllByUser(int $id): ?array
    {
        $ads = [];
        try {
            $stmt = DbConnect::getDb()->prepare("SELECT * FROM \"annonce\" WHERE id_user = ?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ads[] = new Ad($row['id_annonce'], $row['title'], $row['localisation'], $row['description'], $row['price'], $row['id_user']);
            }
            return $ads;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return null;
    }
}