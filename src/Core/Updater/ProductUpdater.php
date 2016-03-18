<?php


namespace App\Core\Updater;


use App\Core\Amazon\AmazonHelper;
use App\Model\Entity\Product;
use Cake\ORM\TableRegistry;
use Model\Entity\Price;

class ProductUpdater
{
    private $productsTable;
    private $pricesTable;
    private $companiesTable;
    private $now;
    private $amazon;

    function __construct()
    {
        $this->amazon = new AmazonHelper();
        $this->productsTable = TableRegistry::get('products');
        $this->pricesTable = TableRegistry::get('prices');
        $this->companiesTable = TableRegistry::get('companies');
        date_default_timezone_set('America/Toronto');
        $this->now  = date('Y/m/d H:i:s');
    }

    /**
     * @param $articleUid
     * @return \App\Core\Amazon\AbstractItem
     * @throws Exception
     */
    function updateProduct($articleUid){
        $product = $this->productsTable
            ->find()
            ->contain(['Prices'])
            ->where(['article_uid' => $articleUid])
            ->first();

        if(isset($product)){
            $interval = $this->compareTime($product->price->date);
            if($interval->d > 0){
                $apiItem = $this->fetchProductFromApi($articleUid);
                $this->updatePrice($apiItem, $product);
            }
        }
        else{
            $apiItem = $this->fetchProductFromApi($articleUid);
            $this->createProduct($apiItem);
            $this->updatePrice($apiItem);
        }
    }

    function createProduct($apiItem){
        $companyRow = $this->companiesTable->find()->where(['name'=> 'Amazon'])->first();
        $product = new Product();
        $product->name = $apiItem->name;
        $product->company_id = $companyRow->id;
        $product->article_uid = $apiItem->uid;
        $product->imageLink = $apiItem->largeImageLink;
        if ($this->productsTable->save($product)){
            $this->updatePrice($apiItem, $product);
        } else {
            throw new Exception('Save new product failed.');
        }
    }

    function updatePrice($apiItem, $product){
        $this->out("updating price");

        $fullPrice = $apiItem->fullprice/100;

        $price = new Price();
        $price->date = $this->now;
        $price->price = $fullPrice;
        $price->product_id = $product->id;
        $price->rebate_price = $apiItem->currentPrice;
        $price->rebate_amount = null;

        if ($this->pricesTable->save($price)){
            $newPriceId = $price->id;
        } else {
            throw new Exception('Save new price failed.');
        }
    }

    private function compareTime($lastPriceUpdate){
        return $interval = $lastPriceUpdate->diff($this->now);
    }

//    private function extractNumber($strToInt)
//    {
//        preg_match('!((?:\d,?)+\d\.[0-9]*)!', $strToInt, $matches);
//        return floatval($matches[0]);
//    }

    private function fetchProductFromApi($articleUid)
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