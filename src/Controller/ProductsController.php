<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 19/02/2016
 * Time: 09:19
 */

namespace App\Controller;


use Cake\Controller\Controller;


/**
 * @property bool|object Products
 */
class ProductsController extends Controller
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash');
    }

    public function product()
    {
        $product = $this->Products->find('all');

        $this->set(compact('product'));
    }

}