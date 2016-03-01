<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 26/02/2016
 * Time: 09:11
 */

namespace Model\ViewModel;


class ProductsViewModel
{

    private $name;
    private $companyName;
    private $price;
    private $rating;
    private $description;

    function __construct($name , $companyName, $lastPrice, $rating, $description)
    {
        $this->name = $name;
        $this->companyName = $companyName;
        $this->price = $lastPrice;
        $this->rating = $rating;
        $this->description = $description;
    }

    public function __get($property)
    {
        if(property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if(property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function getName() {
        return $this->name;
    }


}