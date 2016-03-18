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

    

}