<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 04/03/2016
 * Time: 09:09
 */

namespace App\Model\Entity;


use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * @property mixed id
 */
class Product extends Entity
{
    public function _getPrices() {
        $prices = TableRegistry::get('Prices');
        return $prices->find()->where(['Prices.product_id'=>$this->id]);
    }
}