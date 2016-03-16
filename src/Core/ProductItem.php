<?php
/**
 * Created by PhpStorm.
 * User: Hippolyte Glaus
 * Date: 16/03/16
 * Time: 11:09 AM
 */

namespace App\Core;

class ProductItem extends item
{

    function __construct()
    {
    }

    function __construct2($article_uid, $name, $currentPrice, $description, $rating, $type)
    {
        $this->article_uid =$article_uid;
        $this->name = $name;
        $this->currentPrice = $currentPrice;
        $this->description = $description;
        $this->rating =$rating;
        $this->type = $type;
    }

    public function __get($property)
    {
        if (property_exists($this, $property))
        {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property))
        {
            $this->$property = $value;
        }
    }
}