<?php
/**
 * Created by PhpStorm.
 * User: Hippolyte Glaus
 * Date: 04/03/16
 * Time: 5:33 PM
 */

namespace App\Shell;

use App\Core\Amazon\AmazonHelper;
use App\Core\ProductItem;
use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use DateTime;
use DateTimeZone;
use Exception;
use Model\Entity\Price;


/**
 * -------Pour caller le service-------
 * $update = new PriceUpdateShell()
 * $itemUpdate = $update->main(item-uid);
 * -------------------------------------
 * Class PriceUpdateShell
 * @package App\Shell
 */
class PriceUpdateShell extends Shell
{
    private $productsTable;
    private $pricesTable;
    private $now;

    public function main($itemUid = null){

        $this->productsTable = TableRegistry::get('products');
        $this->pricesTable = TableRegistry::get('prices');
        $this->now = new DateTime(null, new DateTimeZone('America/Toronto'));

        if($itemUid == null){
            $this->updateAllProduct();
        } else{

           return $this->updateOneProduct($itemUid);
        }
        return "succes";
    }

    private function updateAllProduct(){
        $this->out(date('m/d/Y h:i:s a') . 'Daily update started');

        $query = $this->productsTable->find()->contain(['Prices']);

        foreach ($query as $row) {
            $this->out($row->name);
            $this->out($row->price->price);

            $interval = $this->compareTime($row->price->date);

//            $this->out($interval->format('%R%a days'));
            if($interval->d > 0){
                $this->updatePrice($row);
            }
        }
        sleep(10);
        $this->out(date('m/d/Y h:i:s a') .'Daily update ended');
    }

    /**
     * @param $itemUid Product UDI to be fetched.
     * @return \App\Core\Amazon\AbstractItem
     */
    private function updateOneProduct($itemUid){
        $product = $this->productsTable
            ->find()
            ->contain(['Prices'])
            ->where(['article_uid' => $itemUid])
            ->first();

        if($product == null){
            return $this->fetchProductFromAmazon($itemUid);

        } else {
//            $interval = $this->compareTime($product->price->date);
//
//            if($interval->d > 0){
//                $this->updatePrice($product);
//            }

            return $this->transformProductToProductItem($product);
        }
    }


    function updatePrice($productRow){
        $this->out("updating price");

        $amazon = new AmazonHelper();
        $new_price_table = $amazon->findProduct($productRow->article_uid);
        $price_int = $this->extractNumber($new_price_table->currentFormattedPrice);

        $price = new Price();
        $price->date = $this->now;
        $price->price = $price_int;
        $price->product_id = $productRow->id;
        $price->rebate_price = null;
        $price->rebate_amount = null;

        if ($this->pricesTable->save($price)){
            $newPriceId = $price->id;
        } else {
            throw new Exception('Save new price failed.');
        }

//        update price_id of product_row
        $product = $this->productsTable->get($productRow->id);
        $product->price_id = $newPriceId;
        $this->productsTable->save($product);
    }

    private function compareTime($lastPriceUpdate){
        return $interval = $lastPriceUpdate->diff($this->now);
    }

    private function extractNumber($strToInt)
    {
        preg_match('!((?:\d,?)+\d\.[0-9]*)!', $strToInt, $matches);
        return floatval($matches[0]);
    }

    private function fetchProductFromAmazon($itemUid)
    {
        $amazon = new AmazonHelper();
        return $amazon->findProduct($itemUid);
     }

    private function transformProductToProductItem($product)
    {
        $this->out($product->price_id);
        $currentPrice = $this->productsTable
            ->find()
            ->contain(['Prices'])
            ->where(['price_id' => $product->price_id])
            ->first();

        $productItem = new ProductItem();
        $productItem->article_uid =$product->article_uid;
        $productItem->name = $product->name;
        $productItem->currentPrice = $currentPrice;
        $productItem->description = $product->description;
        $productItem->rating =$product->rating;
        $productItem->type = $product->type;

        return $productItem;
    }

}