<?php
/**
 * Created by PhpStorm.
 * User: Hippolyte Glaus
 * Date: 04/03/16
 * Time: 5:33 PM
 */

namespace App\Shell;

use App\Core\Updater\ProductUpdater;
use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use DateTime;
use DateTimeZone;

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
    public function main(){

        $this->productsTable = TableRegistry::get('products');
        $this->pricesTable = TableRegistry::get('prices');
        $this->now = new DateTime(null, new DateTimeZone('America/Toronto'));

        $this->updateAllProduct();
    }

    private function updateAllProduct(){
        $this->out(date('m/d/Y h:i:s a') . 'Daily update started');
        $productUpdater = new ProductUpdater();

        $query = $this->productsTable->find();
        foreach ($query as $row) {

            $product = $this->pricesTable->find()
                ->order(['id' => 'DESC'])
                ->first();
                $this->out($product->id);            
                $interval = $productUpdater->compareTime($product->date);

            if($interval->d > 0){
                $this->out("yay");
                $apiProduct = $productUpdater->fetchProductFromApi($product->articleUid);
                $productUpdater->updatePrice($apiProduct, $row);

            }
        }
        $this->out(date('m/d/Y h:i:s a') .'Daily update ended');
    }

}
