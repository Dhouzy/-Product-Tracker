<?php
/**
 * Created by PhpStorm.
 * User: gogo
 * Date: 20/02/16
 * Time: 10:39 PM
 */

namespace App\Model\Entity;


use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

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

    }
}