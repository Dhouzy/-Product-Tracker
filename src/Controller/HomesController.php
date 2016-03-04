<?php
/**
 * Created by PhpStorm.
 * User: gogo
 * Date: 19/02/16
 * Time: 10:44 AM
 */

namespace App\Controller;


class HomesController extends AppController
{

    public function home() {
        if ($this->request->is('post')) {
            $received = $this->request->data;
            $this->Flash->success(__('Your search for '.$received['search'].' returned no results.'));
        }
    }

}