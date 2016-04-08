<?php


namespace App\Core\Updater;

use DateTimeZone;
use Exception;
use DateTime;
use App\Core\Amazon\AmazonHelper;
use App\Model\Entity\Product;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Price;

class ProductUpdater
{
    private $productsTable;
    private $pricesTable;
    private $companiesTable;
    private $amazon;

    function __construct()
    {
        $this->amazon = new AmazonHelper();
        $this->productsTable = TableRegistry::get('products');
        $this->pricesTable = TableRegistry::get('prices');
        $this->companiesTable = TableRegistry::get('companies');
        date_default_timezone_set('America/Toronto');
    }

    /**
     * @param $articleUid
     * @return \App\Core\Amazon\AbstractItem
     * @throws Exception
     */
    function updateProduct($articleUid){
        $product = $this->productsTable
            ->find()
            ->where(['article_uid' => $articleUid])
            ->first();

        $apiItem = $this->fetchProductFromApi($articleUid);
        if(isset($product)){
            $latestPrice = $this->pricesTable
                ->find()
                ->where(['product_id'=>$product->id])
                ->orderDesc('date')
                ->first();


            $interval = $this->compareTime($latestPrice->date);
            if($interval->d > 0){
                $this->updatePrice($apiItem, $product);
            }
        }
        else{
            $this->createProduct($apiItem);
        }
    }

    function createProduct($apiItem){
        $companyRow = $this->companiesTable->find()->where(['name'=> 'Amazon Canada'])->first();
        $product = new Product();
        $product->name = $apiItem->name;
        $product->brand = $apiItem->brand;
        $product->color = $apiItem->color;
        $product->company_id = $companyRow->id;
        $product->article_uid = $apiItem->uid;
        $product->lengthmm = $apiItem->length;
        $product->widthmm = $apiItem->width;
        $product->heightmm = $apiItem->height;
        $product->weightmm = $apiItem->weight;
        $product->image_link = $apiItem->largeImageLink;
        $product->amazon_url = $apiItem->amazonUrl;
        $product->review_url = $apiItem->reviewUrl;
        if ($this->productsTable->save($product)){
            $product = $this->productsTable
                ->find()
                ->where(['article_uid' => $product->article_uid])
                ->first();
            $this->updatePrice($apiItem, $product);
        } else {
            throw new Exception('Save new product failed.');
        }
    }

    function updatePrice($apiItem, $product){
        $now  = new DateTime(null, new DateTimeZone('America/Toronto'));

        $fullPrice = $apiItem->fullPrice/100;

        $price = new Price();
        $price->date = $now;
        $price->price = $fullPrice;
        $price->product_id = $product->id;
        $price->rebate_price = $apiItem->currentPrice/100;
        $price->rebate_amount = null;

        if ($this->pricesTable->save($price) === false){
            throw new Exception('Save new price failed.');
        }
    }

    public function compareTime($lastPriceUpdate){
        $now  = new DateTime(null, new DateTimeZone('America/Toronto'));
        return $interval = $lastPriceUpdate->diff($now);
    }

//    private function extractNumber($strToInt)
//    {profile.less
//        preg_match('!((?:\d,?)+\d\.[0-9]*)!', $strToInt, $matches);
//        return floatval($matches[0]);
//    }

    public function fetchProductFromApi($articleUid)
    {
        $amazon = new AmazonHelper();
        return $amazon->findProduct($articleUid);
    }

//    private function transformProductToProductItem($product)
//    {
//        $this->out($product->price_id);
//        $currentPrice = $this->productsTable
//            ->find()
//            ->contain(['Prices'])
//            ->where(['price_id' => $product->price_id])
//            ->first();
//
//        $productItem = new ProductItem();
//        $productItem->article_uid =$product->article_uid;
//        $productItem->name = $product->name;
//        $productItem->currentPrice = $currentPrice;
//        $productItem->description = $product->description;
//        $productItem->rating =$product->rating;
//        $productItem->type = $product->type;
//
//        return $productItem;
//    }
}
