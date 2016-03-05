<?php
/**
 * Created by PhpStorm.
 * User: Hippolyte Glaus
 * Date: 04/03/16
 * Time: 5:33 PM
 */

namespace App\Shell;
use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use DateTime;
use DateTimeZone;

class PriceUpdateShell extends Shell
{

    public function main(){
        $this->out('Daily update started');

        $products = TableRegistry::get('products');
        $prices = TableRegistry::get('prices');
        $query = $products->find();

        foreach ($query as $row) {
            $this->out($row->name);

            //get the prices column
            $product_price_id = $row->last_price_id;
            $row_price = $prices->get($product_price_id);
            $this->out($row_price->get("price"));

            //compare 2 dates
            $interval = $this->compareTime($row_price);

            $this->out($interval->format('%R%a days'));
            if($interval->d > 0){
                $this->updatePrice($row);
            }
        }
        $this->out('Daily update ended');
    }

    function updatePrice($product_row){
        $this->out("updating price");
        $prices = TableRegistry::get('prices');
        $products = TableRegistry::get('prices');

        //call service api / adapter_api
        $new_price = null;

        //create new price row
        $query = $prices->query();
        $query->insert(['date', 'price', 'product_id'])
            ->values([
                'date' => $new_price->date,
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
        $query = $products->query();
        $query->update()
            ->set(['last_price_id' => $last_insert_id])
            ->where(['id' => $product_row->id])
            ->execute();
    }

    private function compareTime($row_price){
        $now = new DateTime(null, new DateTimeZone('America/Toronto'));
//        echo $now->format('Y-m-d H:i:s');    // MySQL datetime format

        $last_price_update = $row_price->get("date");
        return $interval = $last_price_update->diff($now);
    }

}