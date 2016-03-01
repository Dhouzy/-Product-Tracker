<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 19/02/2016
 * Time: 09:19
 */

namespace App\Controller;


use Cake\Controller\Controller;
use Model\ViewModel\ProductsViewModel;
use Cake\ORM\TableRegistry;

/**
 * @property bool|object Products
 * @property bool|object Companies
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
        $nam = $product->__get("name");
        $this->set('name',$nam);
    }

    private function getProductsViewmModel($id) {
        $companies = TableRegistry::get('Companies');
        $product = $this->Products->get($id);
        $company = $companies->get(1);
        $product = new ProductsViewModel($product->name, $company->name, 10, $product->rating, $product->description );
        return $product;
    }

}