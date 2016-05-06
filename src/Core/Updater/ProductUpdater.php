<?php


namespace App\Core\Updater;

use DateTimeZone;
use Exception;
use DateTime;
use App\Core\Amazon\AmazonHelper;
use App\Core\ProductItem;
use App\Model\Entity\Product;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Price;

class ProductUpdater
{
    private $productsTable;
    private $pricesTable;
    private $companiesTable;
    private $amazon;

    public function __construct()
    {
        $this->amazon = new AmazonHelper();
        $this->productsTable = TableRegistry::get('products');
        $this->pricesTable = TableRegistry::get('prices');
        $this->companiesTable = TableRegistry::get('companies');
        date_default_timezone_set('UTC');
    }

    /**
     * @param $articleUid
     * @return \App\Core\Amazon\AbstractItem
     * @throws Exception
     */
    public function updateProduct($articleUid){
        $product = $this->productsTable
            ->find()
            ->where(['article_uid' => $articleUid])
            ->first();

        if(isset($product)){
            $latestPrice = $this->pricesTable
                ->find()
                ->where(['product_id'=>$product->id])
                ->orderDesc('date')
                ->first();


            $interval = $this->compareTime($latestPrice->date);
            if($interval->i > 0){ // one minute
                $apiItem = $this->fetchProductFromApi($articleUid);
                $this->updatePrice($apiItem, $product);
            }
        } else {
            $apiItem = $this->fetchProductFromApi($articleUid);
            $this->createProduct($apiItem);
        }
    }

    public function createProduct($apiItem){
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
        $product->weightmg = $apiItem->weight;
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

    public function updatePrice($apiItem, $product){
        $now  = new DateTime(null, new DateTimeZone('UTC'));

        $fullPrice = $apiItem->fullPrice/100;
        $rebate_amount = null;
        if($apiItem->fullPrice == null){
            $rebatePrice = 0;
            $fullPrice = $apiItem->currentPrice/100;
        }else{
            $rebatePrice =  $apiItem->currentPrice/100;
            $rebate_amount = $fullPrice - $rebatePrice;
        }

        $price = new Price();
        $price->date = $now;
        $price->price = $fullPrice;
        $price->product_id = $product->id;
        $price->rebate_price = $rebatePrice;
        $price->rebate_amount = $rebate_amount ;

        if ($this->pricesTable->save($price) === false){
            throw new Exception('Save new price failed.');
        }
    }

    public function compareTime($lastPriceUpdate){
        $now  = new DateTime(null, new DateTimeZone('UTC'));
        return $interval = $lastPriceUpdate->diff($now);
    }

    public function fetchProductFromApi($articleUid)
    {
        $amazon = new AmazonHelper();
        return $amazon->findProduct($articleUid);
    }
}
