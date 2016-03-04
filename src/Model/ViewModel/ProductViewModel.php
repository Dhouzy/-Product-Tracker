<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 26/02/2016
 * Time: 09:11
 */

namespace App\Model\ViewModel;

class ProductViewModel
{

    private $name;
    private $companyName;
    private $price;
    private $rating;
    private $description;
    private $imageLink;

    function __construct($name, $companyName, $lastPrice, $rating, $description, $imageLink)
    {
        $this->name = $name;
        $this->companyName = $companyName;
        $this->price = $lastPrice;
        $this->rating = $rating;
        $this->description = $description;
        $this->imageLink = $imageLink;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}