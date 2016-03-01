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
        $this->set(compact('product'));
    }


    private function getProductsViewmModel($id) {
        $companies = TableRegistry::get('Companies');
        $product = $this->Products->get($id);
        $company = $companies->get(1);
        $product = new ProductViewModel($product->name, $company->name, 10, $product->rating, $product->description );
        return $product;
    }

}