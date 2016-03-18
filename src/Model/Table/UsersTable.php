<?php
/**
 * Created by PhpStorm.
 * User: Hippolyte Glaus
 * Date: 19/02/16
 * Time: 5:38 PM
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Query;

class UsersTable extends Table
{

    public function initialize(array $config)
    {
        $this->belongsToMany('Products');
    }

    public function validationDefault(Validator $validator)
    {
        $this->entityClass('App\Model\Entity\User');
        return $validator
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('email', 'A password is required')
            ->notEmpty('first_name', 'A name is required')
            ->notEmpty('last_name', 'A last name is required')
            ->allowEmpty('phone')
            ->allowEmpty('street_number')
            ->allowEmpty('street')
            ->allowEmpty('city')
            ->allowEmpty('province')
            ->allowEmpty('country');
    }

    public function findEmailAlreadyExists(Query $query, array $options){
        $count = $query->where(['email' => $options['email']])
            ->count();

        return $count > 0;
    }

    public function findUsernameAlreadyExists(Query $query, array $options){
        $count = $query->where(['username' => $options['username']])
            ->count();

        return $count > 0;
    }

    public function findUserById(Query $query, array $options) {
        $id = $options['id'];
        return $query->where(['id' => $id]);
    }
}