<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 19/02/2016
 * Time: 09:19
 */

namespace App\Controller;

use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
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

    private $productUpdater;

    public function initialize(){
        parent::initialize();
        $this->productUpdater = new ProductUpdater();
    }

    public function product($uid){
        if (isset($uid)) {
            $item = $this->productUpdater->updateProduct($uid);
            
            $products = TableRegistry::get('Products');
            $product = $products
                ->find()
                ->contain(['Companies', 'Prices'])
                ->where(['article_uid' => $uid])
                ->first();

            $isUserLoggedIn = $this->isUserLoggedIn();
            $isItemFollowed = false;
            if($isUserLoggedIn){
                $isItemFollowed = $this->isItemFollowed($product);
            }
            $this->set(compact('item', 'product', 'isUserLoggedIn', 'isItemFollowed'));
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
    
    private function isUserLoggedIn(){
        $user = $this->request->session()->read('Auth.User');
        return isset($user);
    }

    private function isItemFollowed($product){
        $userLogged = $this->request->session()->read('Auth.User');
        $product_users = TableRegistry::get('ProductsUsers');
        return $product_users->exists([
            'user_id' => $userLogged['id'],
            'product_id' => $product->id]);
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['product']);
    }
}