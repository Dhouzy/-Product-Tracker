<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 04/03/2016
 * Time: 10:35
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class ProductsUsersTable extends Table
{
    public function initialize(array $config)
    {
        $this->hasMany('Products');
        $this->hasMany('Users');
    }
}