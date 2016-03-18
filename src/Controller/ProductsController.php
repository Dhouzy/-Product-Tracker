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
use App\Model\Entity\ProductsUser;
use App\Model\Table\ProductsTable;
use App\Core\Updater\ProductUpdater;

/**
 * Class ProductsController
 * @package App\Controller
 */
class ProductsController extends AppController
{

    private $uid;
    private $productUpdater;

    public function initialize(){
        parent::initialize();
        $this->productUpdater = new ProductUpdater();
    }

    public function product(){
        if (isset($this->request->uid)) {
            $articleUid = $this->request->uid;
            $item = $this->productUpdater->updateProduct($articleUid);
            
            $products = TableRegistry::get('products');
            $product = $products
                ->find()
                ->contain(['Companies', 'Prices'])
                ->where(['article_uid' => $articleUid])
                ->first();

            $this->set(compact('item', 'product'));
        }
    }

    public function addToUser(){
        if($this->request->is('post')){
            $uid = $this->request->data['uid'];
            $productId = $this->Products->find('productId', ['uid' => $uid]);

            if($productId == null){
                $this->Flash->error(__('Flash.InvalidUID'));
            } else {
                $this->loadModel('ProductsUsers');
                $newUserProduct = new ProductsUser();
                $newUserProduct->user_id = $this->request->session()->read('Auth.User')['id'];
                $newUserProduct->product_id = $productId;
                $this->ProductsUsers->save($newUserProduct);
                $this->Flash->success(__('Flash.ProductAdded'));
            }
        }

        $this->redirect(['controller' => 'Users', 'action' => 'profile']);
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['product']);
    }
}