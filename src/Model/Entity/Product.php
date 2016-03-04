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
 * @property mixed company_id
 */
class Product extends Entity
{
    public function _getCompanyName() {
        $company = TableRegistry::get('Companies');
        return $company->get($this->company_id)->name;

    }
}