<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 19/02/2016
 * Time: 09:19
 */

namespace App\Controller;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Core\Updater\ProductUpdater;

/**
 * Class ProductsController
 * @package App\Controller
 */
class ProductsController extends AppController
{

    private $uid;
    private $productUpdater;

    public function initialize()
    {
        parent::initialize();
        $this->productUpdater = new ProductUpdater();
    }

    public function product()
    {
        if (isset($this->request->uid)) {
            $articleUid = $this->request->uid;
            $this->productUpdater->updateProduct($articleUid);

            $products = TableRegistry::get('products');
            $product = $products
                ->find()
                ->contain(['Companies', 'Prices'])
                ->where(['article_uid' => $articleUid])
                ->first();

            $this->set(compact('product'));
        }
    }

    public function addToUser()
    {

    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['product']);
    }
}