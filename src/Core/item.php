<?php
/**
 * Created by PhpStorm.
 * User: Hippolyte Glaus
 * Date: 16/03/16
 * Time: 11:02 AM
 */

namespace App\Core;


use Exception;

abstract class item
{
    public $article_uid;
    public $name;
    public $productLink;
    public $currentPrice;
    public $maxPrice;
    public $lowestPrice;
    public $description;
    public $rating;
    public $type;

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