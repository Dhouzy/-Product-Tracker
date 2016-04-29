<?php
/**
 * AppController
 * Created by Product_Tracker
 * Since: 04 Mar 2016
 */
namespace App\Controller;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Model\Entity\ProductsUser;
use App\Model\Entity\Product;
use App\Model\Entity\Price;
use App\Core\Updater\ProductUpdater;

/**
 * Application Controller for application wide methods
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class GraphicsController extends AppController
{

    public function initialize(){
        parent::initialize();
    }

    public function graphics() {
        if($this->request->is('post')) {
            $productId = $this->request->data['productId'];

            $products = TableRegistry::get('Products');
            $product = $products
                ->find()
                ->contain(['Companies', 'Prices'])
                ->where(['article_uid' => $productId])
                ->first();

            $graph1Data = array();
            $graph2Data = array();

            foreach ($product->prices as $price) {
                $dateFormat = date_format(date_create($price->date),"Y-m-d");

                $oPrice = (object) [
                    'date' => $dateFormat,
                    'price' => $price->price
                ];
                $graph1Data[] = $oPrice;

                if($price->rebate_price > 0){
                    $oRebatePrice = (object) [
                        'date' => $dateFormat,
                        'price' => $price->rebate_price
                    ];
                    $graph2Data[] = $oRebatePrice;
                }
            }

            $this->set(compact('graph1Data', 'graph2Data'));
        }
    }
}
