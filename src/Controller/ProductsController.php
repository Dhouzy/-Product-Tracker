<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 19/02/2016
 * Time: 09:19
 */

namespace App\Controller;


use Cake\Controller\Controller;
use App\Model\ViewModel\ProductViewModel;

/**
 * @property bool|object Products
 * @property bool|object Companies
 * @property bool|object Users
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
        $product = $this->getProductsViewmModel(1);
        $this->set(compact('product'));
    }


    private function getProductsViewmModel($id) {
        $product = $this->Products->get($id);
        $product = new ProductViewModel($product->name, $product->_getCompanyName(), 10, $product->rating, $product->description );
        return $product;
    }

}