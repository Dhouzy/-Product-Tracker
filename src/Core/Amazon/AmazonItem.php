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
        public $uid;
        public $name;
        public $amazonUrl;
        public $fullPrice;
        public $currentPrice;
        public $smallImageLink;
        public $largeImageLink;
        public $currentFormattedPrice;
        public $brand;
        public $color;
        public $length;
        public $width;
        public $height;
        public $weight;
        public $reviewUrl;

        public function __construct($uid, $name, $link)
        {
            $this->uid = $uid;
            $this->name = $name;
            $this->amazonUrl = $link;
        }

    }