<?php

namespace model;

require_once "Image.php";
require_once "DbConnect.php";
require_once "DaoInterface.php";

use PDO;
use PDOException;

/**
 * Data access object in the database for images.
 */
class ImageDao implements DaoInterface
{
    /**
     * @return Image|null the selected image or null if not found
     */
    public function selectById(int $id): ?Image
    {
        try {
            $stmt = DbConnect::getDb()->prepare("SELECT * FROM \"annonce_image\" WHERE id_image = ?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row ? new Image($id, $row['id_annonce'], $row['image']) : null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return null;
    }

    /**
     * Selects one or multiple images from the unique id of its associated advertisement.
     *
     * @param int $annonceId the unique id of the advertisement.
     * @return array contains all selected images.
     */
    public function getByAnnonceId(int $annonceId): array
    {
        $images = [];
        try {
            $stmt = DbConnect::getDb()->prepare("SELECT * FROM annonce_image WHERE id_annonce = ?");
            $stmt->bindValue(1, $annonceId);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $images[] = new Image($row['id_image'], $annonceId, $row['image']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $images;
    }

    /**
     * @return array an array containing all the existing selected images.
     */
    public function selectAll(): array
    {
        $images = [];
        try {
            $stmt = DbConnect::getDb()->query("SELECT * FROM annonce_image");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $images[] = new Image($row['id_image'], $row['id_annonce'], $row['image']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $images;
    }

    /**
     * @param Image|Model $data the image to create in the db, of Model descent.
     * @return bool indicates if the insertion was successful (true) or not (false).
     */
    public function insert(Image|Model $data): bool
    {
        $conn = DbConnect::getDb();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO annonce_image (id_annonce, image) VALUES (?, ?) RETURNING id_image");
            $stmt->bindValue(1, $data->annonce_id);
            $stmt->bindValue(2, $data->url);
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
     * @param Image|Model $data the already updated image corresponding to the image to update in the db.
     * Thus, be careful to have matching id's.
     * @return bool indicates if the insertion was successful (true) or not (false).
     */
    public function update(Image|Model $data): bool
    {
        $conn = DbConnect::getDb();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare("UPDATE annonce_image SET image = ?, id_annonce = ? WHERE id_image = ?");
            $stmt->bindValue(1, $data->url);
            $stmt->bindValue(2, $data->annonce_id);
            $stmt->bindValue(3, $data->id);
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
            $stmt = $conn->prepare("DELETE FROM annonce_image WHERE id_image = ?");
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
