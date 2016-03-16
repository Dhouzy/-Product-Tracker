<?php
/**
 * Created by PhpStorm.
 * User: Hippolyte Glaus
 * Date: 20/02/16
 * Time: 10:39 PM
 */

namespace App\Model\Entity;


use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class User extends Entity
{
    // Make all fields mass assignable except for primary key field "id".
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    // ...

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }

    public function _getProducts() {
        $userProductsTable = TableRegistry::get('user_products');
        $usersProducts = $userProductsTable->find('all')->where(['user_id' => $this->id])->toArray();
        return $this->getProductsFromUserProduct($usersProducts);
    }

    private function getProductsFromUserProduct($userProducts) {
        $productsTable = TableRegistry::get('Products');
        $products = array();
        foreach($userProducts as $userProduct) {
            $product = $productsTable->get($userProduct->product_id);
            $products[] = $product;
        }
        return $products;
    }
}