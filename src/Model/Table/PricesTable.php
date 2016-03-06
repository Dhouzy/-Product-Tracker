<?php
/**
 * PricesTable
 * Created by M-A
 * Since: 05 Mar 2016
 *
 * Prices Table
 */

namespace App\Model\Table;



use Cake\ORM\Table;

class PricesTable extends Table
{
    public function initialize(array $config)
    {
        $this->belongsTo('Products');
        $this->hasOne('Products');
    }
}