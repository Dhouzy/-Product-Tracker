<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 19/02/2016
 * Time: 09:19
 */

namespace App\Controller;

use App\Shell\PriceUpdateShell;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Class ProductsController
 * @package App\Controller
 */
class ProductsController extends AppController
{

    private $uid;
    private $itemUpdate;
    private $updateService;

    public function initialize()
    {
        parent::initialize();
        $this->updateService = new PriceUpdateShell();
    }

    public function product()
    {
        if (isset($this->request->uid)) {
            $item = $this->updateService->main($this->request->uid);

            $products = TableRegistry::get('products');
            //$product = $products->findget($id, ['contain' => ['Companies', 'Prices']]);
            $product = $products->find()->contain(['Companies', 'Prices'])->where(['article_uid' => $this->request->uid])->first();

            $this->set(compact('product'));

            //$this->set(compact('item'));
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