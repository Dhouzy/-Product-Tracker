<?php
/**
 * Created by PhpStorm.
 * User: gogo
 * Date: 19/02/16
 * Time: 10:44 AM
 */

namespace App\Controller;

use Cake\Event\Event;

class HomesController extends AppController
{
    public function home() {

    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['home']);
    }
}