<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/9/16
 * Time: 9:46 PM
 */

namespace App\Core\Amazon;


use App\Core\AbstractItem;

class AmazonItem extends AbstractItem
{
    function __construct($uid, $name, $link){
        $this->uid = $uid;
        $this->name = $name;
        $this->amazonLink = $link;
    }

    public function __set($property, $value){
        switch($property){
            case 'fullPrice':
            case 'currentPrice':
            case 'smallImageLink':
            case 'largeImageLink':
            case 'currentFormattedPrice':
                $this->$property = $value;
                break;
            default:
                throw new \RuntimeException("Property $property may not be set.");
        }
    }
}