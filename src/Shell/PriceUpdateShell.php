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

    public function main(){

        $this->productsTable = TableRegistry::get('products');
        $this->pricesTable = TableRegistry::get('prices');

        $this->updateAllProduct();
    }

    private function updateAllProduct(){
        $this->out(date('m/d/Y h:i:s a') . 'Daily update started');
        $productUpdater = new ProductUpdater();

        $products = $this->productsTable->find();
        foreach ($products as $product) {
            $this->out('Updating: '.$product->name.' with id: '.$product->id);
            $productUpdater->updateProduct($product->article_uid);
        }
        $this->out(date('m/d/Y h:i:s a') .'Daily update ended');
    }

}
