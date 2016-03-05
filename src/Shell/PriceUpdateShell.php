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

        $now = new DateTime(null, new DateTimeZone('America/Toronto'));

        echo $now->format('Y-m-d H:i:s');    // MySQL datetime format

        $products = TableRegistry::get('products');
        $prices = TableRegistry::get('prices');
        $query = $products->find();

        foreach ($query as $row) {
            $this->out($row->name);


            //get the prices column
            $priceId = $row->last_price_id;
            $product_price = $prices->get($priceId);
            $this->out($product_price->get("price"));

            //compare 2 date
            $last_price_update = $product_price->get("date");
            $interval = $now->diff($last_price_update);
            echo $interval->format('%R%a days');

        }
    }


    private function compareTime(){

    }
}