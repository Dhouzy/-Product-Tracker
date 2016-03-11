<?php
/**
 * Created by PhpStorm.
 * User: gogo
 * Date: 19/02/16
 * Time: 10:44 AM
 */
namespace App\Controller;

use Cake\Event\Event;
use App\Core\Amazon\AmazonHelper;

class HomesController extends AppController
{
    public function home() {
        $amazon = new AmazonHelper();
        if ($this->request->is('post')) {
            $received = $this->request->data;

            $searchResult = $amazon->search($received['search'], (isset($received['page']) ? $received['page'] : 1));
            $this->set(compact('searchResult'));
        }
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['home']);
    }
}