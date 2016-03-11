<?php
/**
 * Created by PhpStorm.
 * User: Hippolyte Glaus
 * Date: 04/03/16
 * Time: 5:33 PM
 */

namespace App\Shell;

use App\Core\Amazon\AmazonHelper;
use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use DateTime;
use DateTimeZone;


class PriceUpdateShell extends Shell
{
    private $products;
    private $prices;
    private $now;

    public function main($item = null){
        $this->products = TableRegistry::get('products');
        $this->prices = TableRegistry::get('products');
        $this->now = new DateTime(null, new DateTimeZone('America/Toronto'));

        if($item == null){
            $this->updateAllProduct();
        } else{
            $this->updateOneProduct($item);
        }
    }

    private function updateAllProduct()
    {
        $this->out('Daily update started');

        $query = $this->products->find()->contain(['Prices'])->all();

        foreach ($query as $row) {
            $this->out($row->name);
            $this->out($row->price->price);

            //compare 2 dates
            $interval = $this->compareTime($row->price->date);

            $this->out($interval->format('%R%a days'));
            if($interval->d > 0){
                $this->updatePrice($row);
            }
        }
        $this->out('Daily update ended');
    }

    private function updateOneProduct($item)
    {

    }

    function updatePrice($product_row){
        $this->out("updating price");
//        $prices = TableRegistry::get('prices');

        //call service api / adapter_api
        $amazon = new AmazonHelper();
        $new_price = $amazon->findProduct($product_row->article_uid);

        //create new price row
        $query = $this->prices->query();
        $query->insert(['date', 'price', 'product_id'])
            ->values([
                'date' => $new_price->$this->now,
                'price' => $new_price->price,
                'product_id' => $product_row->id
            ])
            ->execute();

        // IF I RECEIVE A PRICE OBJECT DO IT LIKE THAT(GOOD/BAD??)
//        $query = $articles->query()
//            ->insert(['date', 'price', 'product_id'])
//            ->values($NEW_PRICE_OBJECT)
//            ->execute();

        $last_insert_id =  $query->last();
        $query->select('LAST_INSERT_ID()');

        //update last_price id of product_row
        $query = $this->products->query();
        $query->update()
            ->set(['last_price_id' => $last_insert_id])
            ->where(['id' => $product_row->id])
            ->execute();
    }

    private function compareTime($last_price_update){

//        echo $now->format('Y-m-d H:i:s');    // MySQL datetime format
        return $interval = $last_price_update->diff($this->now);
    }

}