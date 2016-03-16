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

    private function updateAllProduct()
    {
        $this->out('Daily update started');

        $query = $this->productsTable->find()->contain(['Prices']);

        $this->out($query);
        foreach ($query as $row) {
            $this->out($row->name);
            $this->out($row->price->price);

            //compare 2 dates
            $interval = $this->compareTime($row->price->date);

//            $this->out($interval->format('%R%a days'));
            if($interval->d > 0){
                $this->updatePrice($row);
            }
        }
        $this->out('Daily update ended');
    }

    private function updateOneProduct($itemUid)
    {
        $product = $this->productsTable
            ->find()
            ->contain(['Prices'])
            ->where(['article_uid' => $itemUid])
            ->first();

        if($product == null){
            return $this->fetchProductFromAmazon($itemUid);

        }else {
            $interval = $this->compareTime($product->price->date);
            if($interval->d > 0){
                $this->updatePrice($product);
            }

            return $this->transformProductToViewModel($product);
        }
    }


    function updatePrice($product_row){
        $this->out("updating price");

        $amazon = new AmazonHelper();
        $new_price_table = $amazon->findProduct($product_row->article_uid);

        $price_int = $this->extractNumber($new_price_table->currentFormattedPrice);
//        $this->out($price_int);

        $price = new Price();
        $price->date = $this->now;
        $price->price = $price_int;
        $price->product_id = $product_row->id;
        $price->rebate_price = null;
        $price->rebate_amount = null;

        if ($this->pricesTable->save($price)) {
            $newPriceId = $price->id;
        }else{
            throw new Exception('Save new price failed.');
        }

//        update price_id of product_row
        $product = $this->productsTable->get($product_row->id);
        $product->price_id = $newPriceId;
        $this->productsTable->save($product);
    }

    private function compareTime($last_price_update){
        return $interval = $last_price_update->diff($this->now);
    }

    private function extractNumber($str_to_int)
    {
        preg_match('!((?:\d,?)+\d\.[0-9]*)!', $str_to_int, $matches);
        return floatval($matches[0]);
    }

    private function fetchProductFromAmazon($itemUid)
    {
        $amazon = new AmazonHelper();
        return $amazon->findProduct($itemUid);
     }

    private function transformProductToViewModel($product)
    {
        $currentPrice = $this->productsTable
            ->find()
            ->contain(['Prices'])
            ->where(['price_id' => $product->price_id])
            ->first();

        return new ProductItem($product->article_uid, $product->name, $currentPrice, $product->desciption,
            $product->rating, $product->type);
    }

}