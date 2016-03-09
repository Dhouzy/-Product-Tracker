<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 16-03-08
 * Time: 22:40
 */

namespace App\Controller;

use App\Core\Amazon\AmazonHelper;
use Cake\Event\Event;

class SearchesController extends AppController
{
    public function search() {
        $amazon = new AmazonHelper();

        if ($this->request->is('post')) {
            $received = $this->request->data;

            $response = simplexml_load_file($amazon->search($received['search']));
            $this->set('items', $response->items[0]);
        }
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('search');
    }
}