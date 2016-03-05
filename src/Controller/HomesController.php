<?php
/**
 * Created by PhpStorm.
 * User: Hippolyte Glaus
 * Date: 19/02/16
 * Time: 10:44 AM
 */
namespace App\Controller;

use Cake\Event\Event;

class HomesController extends AppController
{

    public function home() {
        $amazon = new AmazonHelper();
        if ($this->request->is('post')) {
            $received = $this->request->data;
            $this->Flash->success(__('Your search for '.$received['search'].' returned no results.'));
            $this->redirect($amazon->search($received['search']));
        }
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['home']);
    }
}