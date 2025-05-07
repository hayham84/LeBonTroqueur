<?php

namespace model;

require_once "Model.php";

/**
 * An image is an object used to describe an advertisement.
 * It displays the product that is being sold.
 * It extends the abstract class Model, which provides a unique identifier.
 *
 * @property int annonce_id the id of the advertisement that contains the image.
 * @property string url the path to the image.
 */
class Image extends Model
{
    protected int $annonce_id;
    protected string $url;

    /**
     * Image constructor.
     *
     * @param int $id the unique id of the image.
     * @param int $annonce_id the id of the advertisement that contains the image.
     * @param string $url the path to the image.
     */
    public function __construct(int $id, int $annonce_id, string $url)
    {
        parent::__construct($id);
        $this->annonce_id = $annonce_id;
        $this->url = $url;
    }
}
