<?php

namespace model;

require_once __DIR__ . "/Model.php";

/**
 * "Ad" stands for advertisement.
 * A user produces an advertisement which indicates that a product is being sold.
 * The advertisement contains all the necessary information.
 * An advertisement is linked to one or multiple images.
 * The image object's id points to the associated advertisement.
 *
 * @property string title the title of the advertisement, or name of the product being sold.
 * @property string description the description of the advertisement and/or product.
 * @property string localisation In what region or place is the product being sold, for hand-to-hand selling.
 * @property int price the price of the service or product.
 * @property int id_user the unique id of the user that created the advertisement.
 */
final class Ad extends Model
{
    protected string $title;
    protected string $description;
    protected string $localisation;
    protected int $price;
    protected int $id_user;

    /**
     * @param int $id the unique id of the advertisement.
     * @param string $title the title of the advertisement, or name of the product being sold.
     * @param string $localisation In what region or place is the product being sold, for hand-to-hand selling.
     * @param string $description the description of the advertisement and/or product.
     * @param int $price the price of the service or product.
     * @param int $id_user the unique id of the user that created the advertisement.
     */
    public function __construct(int $id, string $title, string $localisation, string $description, int $price, int $id_user)
    {
        parent::__construct($id);
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->id_user = $id_user;
        $this->localisation = $localisation;
    }

}