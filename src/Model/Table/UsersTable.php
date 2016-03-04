<?php
/**
 * Created by PhpStorm.
 * User: gogo
 * Date: 19/02/16
 * Time: 5:38 PM
 */

namespace App\Model\Table;


use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('email', 'A password is required')
            ->notEmpty('first_name', 'A name is required')
            ->notEmpty('last_name', 'A last name is required')
            ->notEmpty('role', 'A role is required')
            ->allowEmpty('phone')
            ->allowEmpty('street_number')
            ->allowEmpty('street')
            ->allowEmpty('city')
            ->allowEmpty('province')
            ->allowEmpty('country');
    }
}