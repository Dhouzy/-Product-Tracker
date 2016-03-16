<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/9/16
 * Time: 9:46 PM
 */

namespace App\Core\Amazon;


use App\Core\item;

class AmazonItem extends item
{
    private $amazonLink;
    private $fullPrice;
    public $currentFormattedPrice;
    private $group;
    private $brand;

    function __construct()
    {
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