<?php
/**
 * Created by PhpStorm.
 * User: Hippolyte Glaus
 * Date: 16/03/16
 * Time: 11:02 AM
 */

namespace App\Core;


use Exception;

abstract class AbstractItem
{
    protected $uid;
    protected $name;
    protected $largeImageLink;
    protected $smallImageLink;
    protected $amazonUrl;
    protected $reviewUrl;
    protected $fullPrice;
    protected $currentPrice;
    protected $currentFormattedPrice;
    protected $maxPrice;
    protected $lowestPrice;
    protected $brand;
    protected $color;
    protected $length; // Millimeters
    protected $width;
    protected $height;
    protected $weight; // Milligrams
    protected $rating;
    protected $type;

    public function __get($property){
        if (property_exists($this, $property))
            return $this->$property;
        else
            throw new \RuntimeException("Property $property does not exist.");
    }

    public function setMaxPrice($maxPrice)
    {
        throw new Exception('Not implemented');
        //todo: get max price in bd or api or let implement in child
    }

    public function setLowestPrice($lowestPrice)
    {
        throw new Exception('Not implemented');
        //todo: get lowest price in bd or api or let implement in child
    }
}