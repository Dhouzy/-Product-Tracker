<?php
/**
 * Created by PhpStorm.
 * User: Hippolyte Glaus
 * Date: 16/03/16
 * Time: 11:09 AM
 */

namespace App\Core;

class ProductItem extends AbstractItem
{
    function __construct()
    {
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property))
        {
            $this->$property = $value;
        }
    }
}