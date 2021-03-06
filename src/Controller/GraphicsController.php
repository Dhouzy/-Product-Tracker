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

use \Datetime;
use \DateTimeZone;

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

            foreach ($product->prices as $price) {
                $date = new DateTime($price->date);
                $date->setTimezone(new DateTimeZone('America/Toronto'));
                $dateFormat = $date->format("Y-m-d H:i:s");
                if($price->price > 0) {
                    $oPrice = (object) [
                        'date' => $dateFormat,
                        'price' => $price->price
                    ];
                    $graph1Data[] = $oPrice;
                }
            }

            $this->set(compact('productId', 'graph1Data'));
        }
    }
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['graphics']);
    }
}
