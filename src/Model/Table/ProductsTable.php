<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 19/02/2016
 * Time: 09:20
 */

namespace App\Model\Table;

use Cake\Database\Query;
use Cake\ORM\Table;

class ProductsTable extends Table
{
    public function initialize(array $config)
    {
        $this->belongsTo('Companies');
        $this->hasOne('Prices', [
            'foreignKey' => 'id',
            'bindingKey' => 'price_id'
        ]);
        $this->belongsToMany('Users');
    }

    public function findProductId(Query $query, array $options){
        $result = $query
            ->select(['id'])
            ->where(['article_uid' => $options['uid']])
            ->first();

        if($result == null)
            return null;
        else
            return $result->id;
    }
}