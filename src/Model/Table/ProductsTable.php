<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 19/02/2016
 * Time: 09:20
 */

namespace App\Model\Table;


use Cake\ORM\Table;

class ProductsTable extends Table
{

    public function initialize(array $config)
    {
        $this->belongsTo('companies');
    }
}