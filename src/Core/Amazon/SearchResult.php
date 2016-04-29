<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/9/16
 * Time: 10:42 PM
 */

namespace App\Core\Amazon;

class SearchResult
{

    private $amazonItems = array();
    private $numMaxPages;

    function __construct()
    {
    }

    public function addItem($item)
    {
        $this->amazonItems[] = $item;
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