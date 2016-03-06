<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 19/02/2016
 * Time: 10:48
 */

namespace App\Model\Table;


use Cake\ORM\Table;

class CompaniesTable extends Table
{
    public function initialize(array $config)
    {
        $this->hasMany('Products');
    }
}