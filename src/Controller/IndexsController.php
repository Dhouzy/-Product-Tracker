<?php
/**
 * Created by PhpStorm.
 * User: gogo
 * Date: 19/02/16
 * Time: 10:44 AM
 */

namespace App\Controller;


class IndexsController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash');
    }

    public function index() {
        $this ->set(compact('posts'));
    }

}