<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 19/02/2016
 * Time: 09:19
 */

namespace App\Controller;

use Cake\ORM\TableRegistry;

class ProductsController extends AppController
{

    public function product()
    {
        $id = 1;
        $products = TableRegistry::get('products');
        $product = $products->get($id, ['contain' => ['Companies','Prices']]);
        $this->set(compact('product'));
    }

    public function graphics(){
        $this->set(compact('graphics'));
    }

}